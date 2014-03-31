# Asennusohjeet

## Tarvittavat ohjelmat
1. Lataa ja asenna [Vagrant](http://www.vagrantup.com/downloads.html).  
    * Älä uudelleenkäynnistä konetta pyydettäessä.
2. Lataa ja asenna [VirtualBox](https://www.virtualbox.org/wiki/Downloads). 
3. Jos kielikäännökset kiinnostavat, lataa ja asenna [PoEdit](http://www.poedit.net/download.php)
4. Uudelleenkäynnistä kone.

### Windows
1. Ei tarvitse jos GitBash on jo asennettu
2. Lataa ja asenna [Git](http://git-scm.com/downloads)
    * Oletuksasetuksilla toimii, muuta niitä jos haluat, mutta yritä ensin tietää mitä teet.

## Projekti
1. Lataa projekti zip-tiedostona GitHubista ja pura se jonnekkin.  
2. Avaa command line tool
    * Windowsilla Git Bash!!!
3. Navigoi hakemistoon jonne purit zipin.
4. Aja `vagrant up` (voi kestää hetken)
5. `vagrant ssh`
6. `cd /var/www/zf2koulutus`
7. `php composer.phar self-update`
8. `php composer.phar update`
9. Avaa [192.168.56.101](192.168.56.101)

## Hosts tiedoston editointi (vapaaehtoinen)
###UNIX
1. `sudo nano /etc/hosts`
2. Lisää tiedostoon rivi `192.168.56.101 zf2koulutus.dev`
3. Avaa [zf2koulutus.dev/](zf2koulutus.dev/)

###Windows
1. Avaa Notepad admin oikeuksilla
2. Avaa tiedosto `\system32\drivers\etc\hosts`
    * Jos tiedostoa ei näy, tarkista että näkymässä on kaikki tiedostot, ei vain esim. .txt
3. Lisää tiedostoon rivi `192.168.56.101 zf2koulutus.dev`
4. Avaa [zf2koulutus.dev/](zf2koulutus.dev/)