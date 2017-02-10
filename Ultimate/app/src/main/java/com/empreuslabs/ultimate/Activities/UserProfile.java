package com.empreuslabs.ultimate.Activities;

import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;

import com.empreuslabs.ultimate.R;
import com.empreuslabs.ultimate.utilities.SessionManager;

import java.util.HashMap;

public class UserProfile extends AppCompatActivity {
    SessionManager session;

    private TextView textView, uname,uemail,uphone;
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_user_profile);
        session = new SessionManager(getApplicationContext());
        HashMap<String, String> user = session.getUserDetails();

        textView = (TextView) findViewById(R.id.textViewUserName);
        textView.setText("Welcome User ");

        // email
        String email = user.get(SessionManager.KEY_EMAIL);

        uname=(TextView)findViewById(R.id.textView3);
        uemail=(TextView)findViewById(R.id.textView4);
        uphone=(TextView)findViewById(R.id.textView5);
        Button logout=(Button)findViewById(R.id.log);

        uemail.setText(email);
        logout.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View arg0) {
                // Clear the session data
                // This will clear all session data and
                // redirect user to LoginActivity
                session.logoutUser();
            }
        });
    }

}