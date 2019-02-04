<?php
function sendMail($url, $subj, $data) {
    include 'libmail.php';
    $body = "<h1>".$subj."</h1>
		<table border='1' cellspacing='0' cellpadding='5'>";
    foreach ($data as $key => $value) {
        $body .= "<tr><td>".$key."</td><td>".$value."</td></tr>";
    } $body .= "</table>
	<p>Заявка отправлена с <a href='".$url."'>".$url."</a></p>";
    $m= new Mail;
    $m->From('medproject;no-reply@medproject.com');
    $m->To('romalytar@gmail.com');
    $m->Subject($subj);
    $m->Body($body,'html');
    $m->Send();
}

function sendTestMail($url, $subj, $data) {
    include 'libmail.php';
    $body = "<h1>".$subj."</h1>
		<table border='1' cellspacing='0' cellpadding='5'>";
    foreach ($data as $key => $value) {
        $body .= "<tr><td>".$key."</td><td>".$value."</td></tr>";
    } $body .= "</table>
	<p>Заявка отправлена с <a href='".$url."'>".$url."</a></p>";

    $m= new Mail;
    $m->From('medproject;no-reply@medproject.com');
    $m->To('romalytar@gmail.com');
    $m->Subject($subj);
    $m->Body($body,'html');
    $m->Send();
}
/******************************************************************/
