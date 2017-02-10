package com.empreuslabs.ultimate.Activities;

import android.Manifest;
import android.content.pm.PackageManager;
import android.os.Build;
import android.os.Bundle;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.widget.Toast;

import com.empreuslabs.ultimate.R;
import com.empreuslabs.ultimate.utilities.SessionManager;

public class SplashActivity extends AppCompatActivity implements ActivityCompat.OnRequestPermissionsResultCallback {


    SessionManager session;


    private static final int MY_PERMISSIONS =0 ;

    Thread th = new Thread() {
        @Override
        public void run() {
            try {
                sleep(2000);
                session.checkLogin();
                finish();
            } catch (Exception e) {

            }

        }
    };



    @Override
    protected void onCreate(Bundle savedInstanceState) {

        session = new SessionManager(getApplicationContext());

        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);



        if (Build.VERSION.SDK_INT > 22 ) {
            GetPerm();
        }else{
            th.start();

        }



    }

    ///////////////////////////////////////START///////////////////////////////

    void GetPerm() {

        int permissionCheck = ActivityCompat.checkSelfPermission(this,
                Manifest.permission.WRITE_EXTERNAL_STORAGE);

        int permissionCheck1 = ActivityCompat.checkSelfPermission(this,
                Manifest.permission.ACCESS_FINE_LOCATION);

        if (permissionCheck != PackageManager.PERMISSION_GRANTED&&permissionCheck1 != PackageManager.PERMISSION_GRANTED) {



            // No explanation needed, we can request the permission.
            ActivityCompat.requestPermissions(this,
                    new String[]{Manifest.permission.WRITE_EXTERNAL_STORAGE,Manifest.permission.ACCESS_FINE_LOCATION},
                    MY_PERMISSIONS);


            // MY_PERMISSIONS is an
            // app-defined int constant. The callback method gets the
            // result of the request.

        }else{
            th.start();
        }

    }




    @Override
    public void onRequestPermissionsResult(int requestCode, String permissions[], int[] grantResults) {
        switch (requestCode) {
            case MY_PERMISSIONS: {
                // If request is cancelled, the result arrays are empty.
                if (grantResults.length > 1
                        && grantResults[0] == PackageManager.PERMISSION_GRANTED) {

                    th.start();


                    // permission was granted, yay! Do the
                    // task you need to do.

                } else {
                        th.start();
                    Toast.makeText(SplashActivity.this, "No images will be displayed so choose allow next time",Toast.LENGTH_LONG).show();


                    // permission denied, boo! Disable the
                    // functionality that depends on this permission.
                }
                 return;
            }


        }
    }



    ////////////////////////////////////////END//////////////////////////////


}
