import math
import numpy as np

import querydb as qdb


def get_surficial_data():
    """
    Get dataframe of all marker measurements.
    """

    query = "SELECT * FROM marker_meas"
    
    df = qdb.get_db_dataframe(query)
    
    return df

def get_unprocessed_data():
    """
    Get dataframe of unprocessed marker alert.
    """

    query =  "SELECT * FROM unprocessed"
    
    df = qdb.get_db_dataframe(query)
    
    return df

def disp_time_comp(unprocessed, all_data):
    marker_id = unprocessed['marker_id'].values[0]
    ts2 = unprocessed['ts'].values[0]
    meas2 = unprocessed['meas'].values[0]
    
    prev_data = all_data[(all_data.ts < ts2) & (all_data.marker_id == marker_id)]
    prev_data = prev_data[prev_data.ts == max(prev_data.ts)]
    ts1 = prev_data['ts'].values[0]
    meas1 = prev_data['meas'].values[0]

    unprocessed['displacement'] = np.abs(meas2 - meas1)
    unprocessed['time_delta'] = np.abs(float(ts2 - ts1) / (60 * 60 * 10**9))
    return unprocessed

def alert_comp(df):
    df['vel'] = df['displacement'] / df['time_delta']
    
    df_np = df[np.isnan(df.vel)]
    df_np['alert_level'] = np.nan

    df0 = df[df.vel < 0.25]
    df0['alert_level'] = 0

    df2 = df[(df.vel >= 0.25) & (df.vel < 1.8)]
    df2['alert_level'] = 2

    df3 = df[df.vel >= 1.8]
    df3['alert_level'] = 3

    df = df_np.append(df0).append(df2).append(df3)
    return df


def to_db(df):
    disp = df['displacement'].values[0]
    if math.isnan(disp):
        disp = 'null'
    td = df['time_delta'].values[0]
    if math.isnan(td):
        td = 'null'
    alert = df['alert_level'].values[0]
    if math.isnan(alert):
        alert = 'null'
    query =  "UPDATE marker_data "
    query += "SET displacement = %s, " %disp
    query += "time_delta = %s, " %td
    query += "alert_level = %s " %alert
    query += "WHERE data_id = %s" %df['data_id'].values[0]
    qdb.execute_query(query)

def main():
    unprocessed = get_unprocessed_data()
    
    if len(unprocessed) != 0:
        all_data = get_surficial_data()
        
        unprocessed_grp = unprocessed.groupby('data_id', as_index=False)
        unprocessed = unprocessed_grp.apply(disp_time_comp, all_data=all_data)
        unprocessed = alert_comp(unprocessed)
        
        unprocessed_grp = unprocessed.groupby('data_id', as_index=False)
        unprocessed_grp.apply(to_db)
    
    return unprocessed

if __name__ == '__main__':
    main()