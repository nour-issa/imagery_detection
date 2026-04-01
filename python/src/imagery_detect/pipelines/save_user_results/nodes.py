"""
This is a boilerplate pipeline 'save_user_results'
generated using Kedro 0.18.11
"""
import json

import geopandas as gpd
from shapely import wkb
def save_user_result(user_result):
    gdf = gpd.read_file('C:\\xampp\htdocs\webmap\python\imagery-detect\data\\11_map_objects\\user_objects_data.geojson')
    gdf['geom'] = gdf['geometry'].apply(lambda geom: wkb.dumps(geom))
    gdf.drop(columns=["geometry"], inplace=True)
   
    return gdf
