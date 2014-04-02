# Asennusohjeet

## Tarvittavat ohjelmat
1. Lataa ja asenna/**päivitä** [Vagrant](http://www.vagrantup.com/downloads.html).  
    * Älä uudelleenkäynnistä konetta pyydettäessä.
2. Lataa ja asenna [VirtualBox](https://www.virtualbox.org/wiki/Downloads). 
3. Jos kielikäännökset kiinnostavat, lataa ja asenna [PoEdit](http://www.poedit.net/download.php)
4. Uudelleenkäynnistä kone.

### Windows
1. Lataa ja asenna [Git](http://git-scm.com/downloads) (Skippaa jos GitBash on jo asennettu)
    * Oletusasetuksilla toimii, muuta niitä jos haluat, mutta yritä ensin ainakin tietää mitä teet.

## Projekti
1. Lataa projekti zip-tiedostona GitHubista ja pura se jonnekkin.  
2. Avaa command line tool
    * Windowsilla Git Bash!!!
3. Navigoi hakemistoon jonne purit zipin.
    * Linux/OS X: aja `sudo chmod -R 777 data`
4. Aja `vagrant up` (Kestää 10min+. Käy kahvilla, selaa [Reddittia](http://www.reddit.com/), katselle [kissoja](http://imgur.com/r/cats), or [just wait](http://tvtropes.org/pmwiki/pmwiki.php/Main/WeWait))
5. `vagrant ssh`
6. `cd /var/www/zf2koulutus`
7. `php composer.phar self-update`
8. `php composer.phar update`
9. Avaa [192.168.56.101](http://192.168.56.101)
10. Jos et tarvitse ympäristöä
    1. Poistu virtuaalikoneesta `exit`
    2. Sammuta virtualikone `vagrant halt`
        * Saat virtuaalikoneen taas päälle ajamalla `vagrant up` (paljon nopeammin kuin ensimmäisellä kerralla)

## Hosts tiedoston editointi (vapaaehtoinen)
Mahdollistaa selaimella esim. zf2koulutus.dev/ urlin kutsumisen ip:n sijasta.
###UNIX
1. `sudo nano /etc/hosts`
2. Lisää tiedostoon rivi `192.168.56.101 zf2koulutus.dev`
3. Avaa [zf2koulutus.dev/](http://zf2koulutus.dev/)

###Windows
1. Avaa Notepad admin oikeuksilla
2. Avaa tiedosto `\system32\drivers\etc\hosts`
    * Jos tiedostoa ei näy, tarkista että näkymässä on kaikki tiedostot, ei vain esim. .txt
3. Lisää tiedostoon rivi `192.168.56.101 zf2koulutus.dev`
4. Avaa [zf2koulutus.dev/](zf2koulutus.dev/)