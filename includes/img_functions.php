<?php


	/**
 * insert blob into the files table
 * @param string $filePath
 * @param string $mime mimetype
 */
 function insertBlob($filePath,$mime){
    $blob = fopen($filePath,'rb');
 
    $sql = "INSERT INTO files(mime,data) VALUES(:mime,:data)";
    $stmt = $connection->prepare($sql);
 
    $stmt->bindParam(':mime',$mime);
    $stmt->bindParam(':data',$blob,PDO::PARAM_LOB);
 
    return $stmt->execute();
}

/**
 * update the files table with the new blob from the file specified
 * by the filepath
 * @param int $id
 * @param string $filePath
 * @param string $mime
 * @return boolean
 */
function updateBlob($id,$filePath,$mime) {
 
    $blob = fopen($filePath,'rb');
 
    $sql = "UPDATE files
            SET mime = :mime,
            data = :data
            WHERE id = :id";
 
    $stmt = $connection->prepare($sql);
 
    $stmt->bindParam(':mime',$mime);
    $stmt->bindParam(':data',$blob,PDO::PARAM_LOB);
    $stmt->bindParam(':id',$id);
 
    return $stmt->execute();
 
}
/**
 * select data from the the files
 * @param int $id
 * @return array contains mime type and BLOB data
 */
function selectBlob($id) {
 
    $sql = "SELECT mime,
            data
        FROM files
        WHERE id = :id";
 
    $stmt = $connection->prepare($sql);
    $stmt->execute(array(":id" => $id));
    $stmt->bindColumn(1, $mime);
    $stmt->bindColumn(2, $data, PDO::PARAM_LOB);
 
    $stmt->fetch(PDO::FETCH_BOUND);
 
    return array("mime" => $mime,
             "data" => $data);
}



?>