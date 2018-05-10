import querydb as qdb

def delete_data():
    query =  "DELETE FROM marker_data "
    query += "WHERE meas IS NULL"
    qdb.execute_query(query)

def delete_observation():
    query =  "DELETE FROM marker_observations "
    query += "WHERE mo_id NOT IN ( "
    query += "  SELECT mo_id "
    query += "  FROM marker_data)"
    qdb.execute_query(query)

if __name__ == '__main__':
    delete_data()
    delete_observation()