import pandas.io.sql as psql
import platform
from sqlalchemy import create_engine

curOS = platform.system()

if curOS == "Windows":
    import MySQLdb as mysqlDriver
elif curOS == "Linux":
    import pymysql as mysqlDriver


class Array:
    """
    Self contained array
    """
    def __init__(self, host, user, pw, db):
        self.host = host
        self.user = user
        self.pw = pw
        self.db = db

def mysql_db():
    """
    MySQL credentials in a self contained array
    """

    host = '127.0.0.1'
    user = 'root'
    pw = 'senslope'
    db = 'viernes'
    return Array(host, user, pw, db)

def db_connect():
    """
    Connect python to MySQL database.
    """
    while True:
        try:
            db = mysqlDriver.connect(host=mysql_db().host, user=mysql_db().user,
                                     passwd=mysql_db().pw, db=mysql_db().db)
            cur = db.cursor()
            cur.execute("use "+ mysql_db().db)
            return db, cur
        except mysqlDriver.OperationalError:
            pass

def execute_query(query):
    """
    Execute the given query in MySQL.
    """
    db, cur = db_connect()
    cur.execute(query)
    db.commit()
    db.close()
    
def get_db_dataframe(query):
    """
    Get dataframe output from the given query in MySQL.
    """
    try:
        db, cur = db_connect()
        df = psql.read_sql(query, db)
        db.close()
        return df
    except KeyboardInterrupt:
        pass

def push_db_dataframe(df, table_name, index=True):
    """
    Insert values in df to MySQL.
    """
    engine = create_engine('mysql://' + mysql_db().user + ':' + mysql_db().pw + \
                           '@' + mysql_db().host + ':3306/' + mysql_db().db)
    df.to_sql(name=table_name, con=engine, if_exists='append',
              schema=mysql_db().db, index=index)