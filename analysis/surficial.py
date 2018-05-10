##### IMPORTANT matplotlib declarations must always be FIRST to make sure that matplotlib works with cron-based automation
import matplotlib as mpl
mpl.use('Agg')
import matplotlib.pyplot as plt
import matplotlib.dates as md
plt.ioff()
plt.style.use('seaborn-dark-palette')

import pandas as pd
import sys

import querydb as qdb


def get_surficial_data(site_id, use_plot=False):
    """
    Get dataframe of surficial measurement per marker per marker observation.
    Get only last 10 marker observation if not for plotting.
    """

    query =  "select * "
    query += "from "
    query += "    (select data_id, ts, marker_id, meas, alert_level "
    query += "    from "
    query += "        (select distinct(ts), mo_id from marker_observations "
    query += "        where site_id = %s " %site_id
    query += "        order by ts desc "
    if not use_plot:
        query += "limit 10 "
    query += "        ) as mo "
    query += "      inner join "
    query += "        (select marker_id, data_id, mo_id, meas, alert_level "
    query += "        from "
    query += "            marker_data "
    query += "          inner join "
    query += "            markers "
    query += "          using (marker_id) "
    query += "        ) as marker_meas "
    query += "      using (mo_id) "
    query += "    ) as data "
    query += "  inner join "
    query += "    (select marker_id, name "
    query += "    from "
    query += "        marker_histories "
    query += "      inner join "
    query += "        (select max(ts) as ts, marker_id "
    query += "        from marker_histories "
    query += "        where event_id in ( "
    query += "          select event_id "
    query += "          from marker_events "
    query += "          where event_type in ( "
    query += "            'rename', 'add')) "
    query += "        group by marker_id "
    query += "        ) as hist "
    query += "      using (ts, marker_id) "
    query += "    ) as marker_name "
    query += "  using (marker_id)"
    
    df = qdb.get_db_dataframe(query)
    
    return df

def meas_alert_level(df):
    meas = df['meas'].values[0]
    alert_level = df['alert_level'].values[0]
    meas_alert = {'meas': meas, 'alert_level': alert_level}
    df['meas_alert'] = [meas_alert]
    return df

def format_table(data):
    """
    Format dataframe: column = ts, index = marker name, data = measurement
    """
    
    df = data[['ts', 'meas', 'alert_level']]
    dfts = df.groupby('ts', as_index=False)
    df = dfts.apply(meas_alert_level).reset_index(level=0, drop=True)
    df['ts'] = df['ts'].apply(lambda x: str(x))
    df = df.set_index('ts')
    df = df[['meas_alert']]
    dfT = df.transpose()
    dfT.index = [data['name'].values[0]]
    return dfT

def view_surficial(site_id=''):
    """
    JSON output for viewing of surficial data
    """
    if site_id == '':
        site_id = sys.argv[1].lower()
    data = get_surficial_data(site_id)
    marker_data = data.groupby('marker_id', as_index=False)
    data_table = marker_data.apply(format_table).reset_index(level=0, drop=True)
    json = data_table.to_json()
    with open('surficial' + str(site_id) + '.json', 'w') as w:
        w.write(json)

def plotter(df, ax):
    """
    Plot per marker
    """
    legend = df['name'].values[0]
    data = df[['ts', 'meas']]
    data['ts'] = pd.to_datetime(data['ts'])
    ax.plot(df.ts, data.meas, label=legend, ls='-', marker=None)
    return ax

def surficial_plot(site_id=''):
    """
    Site surficial plot
    """
    if site_id == '':
        site_id = sys.argv[1].lower()
    data = get_surficial_data(site_id, use_plot=True)
    fig = plt.figure()
    ax = fig.add_subplot(111)
    for name in sorted(set(data['name'])):
        marker_data = data[data.name == name]
        ax = plotter(marker_data, ax)
    fmt = md.DateFormatter('%b %Y')
    ax.xaxis.set_major_formatter(fmt)
    plt.legend(loc=2)
    plt.xticks(rotation=45)
    fig.tight_layout()
    plt.savefig('surficial' + str(site_id) + '.png', dpi=200, facecolor='w',
                edgecolor='w', orientation='landscape', mode='w')
    
###############################################################################

if __name__ == "__main__":
    query = "SELECT site_id FROM sites"
    sites = qdb.get_db_dataframe(query)['site_id'].values
    
    for site_id in sites:
        surficial_plot(site_id)