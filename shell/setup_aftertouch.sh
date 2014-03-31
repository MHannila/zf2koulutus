echo 'Creating database'
mysql < /var/www/zf2koulutus/doc/db.sql
echo 'Inserting data into database'
mysql < /var/www/zf2koulutus/doc/data.sql

echo 'Applying nginx conf update'
mv /etc/nginx/conf.d/vhost_autogen.conf /etc/nginx/conf.d/default.conf
echo 'Restarting nginx'
sudo service nginx stop
sudo service nginx start