<?php
try {
	$dbh = new PDO( 'mysql:host=localhost;dbname=itslab',
				'Rasp', 'Rasp',
				array( PDO::ATTR_PERSISTENT => true ) );
    # make sure we get db errors!
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch( PDOException $e ) {
	print "ERROR: ".$e->getMessage();
}
?>