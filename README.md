What?
----
This library lets you control uTorrent using PHP.

* List Torrents
* Add Torrents
* Start / Stop / Pause torrents

How?
----
Enable the web UI in utorrent: http://www.utorrent.com/help/guides/webui

    $utorrent = new \uTorrent\Api($host, $port, $user, $pass);
    $utorrent->getTorrents();

Who?
----
* Originally by Miyanokouji http://forum.utorrent.com/viewtopic.php?id=27414&p=1
* Upgraded by Ultima http://forum.utorrent.com/viewtopic.php?pid=320049#p320049

I've added this to github to aid any future collaboration, add composer support and make it easier for people to find.