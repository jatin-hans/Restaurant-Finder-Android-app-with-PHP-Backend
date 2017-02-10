package com.empreuslabs.ultimate.utilities;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;

/**
 * Created by hp pc on 12-07-2016.
 */
public class ConnectionDetector {

    private Context _context;

    public ConnectionDetector(Context context){
        this._context = context;
    }

    public boolean isConnectingToInternet(){
        ConnectivityManager connectivity = (ConnectivityManager) _context.getSystemService(Context.CONNECTIVITY_SERVICE);
        if (connectivity != null)
        {
            NetworkInfo[] info = connectivity.getAllNetworkInfo();
            //Toast.makeText(_context, "Get Network info:"+ info,Toast.LENGTH_LONG).show();
            if (info != null)
                for (int i = 0; i < info.length; i++)
                    //Toast.makeText(_context, "Get Network info:"+ info.length,Toast.LENGTH_SHORT).show();
                    if (info[i].getState() == NetworkInfo.State.CONNECTED)
                    {
                        return true;
                    }

        }
        return false;
    }




}
