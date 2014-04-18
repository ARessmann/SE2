Readme java App for TweetLoading:

Diese Java-Anwendung erledigt folgende Dinge:
1) Schreibt in die Event-Tabelle, den Status 1
2) Ladet aufgrund von definierten Tweet-Tags (parameter) die Tags in die Tabelle Tweet_Entry
3) Wenn dies fertig ist, wird ein Update auf die Event-Tabelle durchgeführt => Status = 2

Aufrufbar ist die Anwendung folgend:
java -jar tweetLoader.jar parameter_1 parameter_2 parameter_3
parameter_1 => eventId (zB 1)
parameter_2 => hashTags (zB Vettel formel 1 Spielberg)
parameter_3 => tweet_count (zB 50) - kann leer gelassen werden - dann wird default 50 genommen

zB php testcode:

$valueHashTag = $_POST['tweetHashTag'];
$valueEventId = $_POST['eventId2'];
exec('java -jar myApp.jar '.$valueEventId.' '.escapeshellarg($valueHashTag).' 50', $result);
echo "done: ";
var_export($result);


Offen ist noch, wie man mit dem Datum vorgehen werden! (aber fürs erste brauchen wir hier mal keine Einschränkung)
Weiters läuft das alles in einem Thread - jetz müsste man schauen, wie das von Php getestet werden kann. Jedoch sollte das im Background passieren denn wenn mal 1000 Tweets gefunden werden, könnte man in ein Timeout laufen .. @Andi - kannst du das in PHP in den backGround aufrufen?