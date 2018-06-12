# For Linux, this is a casual package (python-mysqldb).
# (You can use sudo apt-get install python-mysqldb (for debian based distros),
# yum install MySQL-python (for rpm-based),or
# dnf install python-mysql (for modern fedora distro) in command line to download.)
import MySQLdb

db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="if17",         # your username
                     passwd="if17",  # your password
                     db="if17_joosep")        # name of the data base

cur = db.cursor()

cur.execute("SELECT * FROM YOUR_TABLE_NAME WHERE id=1 ")

data = cur.fetchall()

db.close()