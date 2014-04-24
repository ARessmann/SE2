Readme java App for TweetLoading:

Die Anwendung kann auf 2 Arten aufgerufen werden:

1) mit einem Parameter (eventId) wo nur f�r dieses Event eine Suche durchgef�hrt wird
2) ohne Parameter, wo f�r alle im System befindlichen Events die Suche durchgef�hrt wird innerhalb des spezifizierten Zeitraums

Diese Java-Anwendung erledigt folgende Dinge:
1) Schreibt in die Event-Tabelle, den Status 1
2) Ladet aufgrund von definierten Tweet-Tags (parameter) die Tags in die Tabelle Tweet_Entry
3) Wenn dies fertig ist, wird ein Update auf die Event-Tabelle durchgef�hrt => Status = 2

Aufrufbar ist die Anwendung folgend:
java -jar tweetLoader.jar parameter_1
parameter_1 => eventId (zB 1)

zB php testcode:
exec('java -jar tweetLoader.jar ', $result);