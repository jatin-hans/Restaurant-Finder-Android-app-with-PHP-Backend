package com.empreuslabs.ultimate.Activities;


import android.app.ProgressDialog;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.view.animation.AnimationUtils;
import android.widget.Button;
import android.widget.EditText;
import android.widget.RelativeLayout;
import android.widget.Toast;

import com.empreuslabs.ultimate.R;
import com.empreuslabs.ultimate.utilities.ConnectionDetector;
import com.empreuslabs.ultimate.utilities.RegisterUserClass;
import com.empreuslabs.ultimate.utilities.SessionManager;

import java.util.HashMap;
import java.util.regex.Matcher;
import java.util.regex.Pattern;

public class ActivityLogin extends AppCompatActivity implements View.OnClickListener{

    public static final String MyPREFERENCES = "MyPrefs" ;
    public static final String Name = "nameKey";
    public static final String Phone = "phoneKey";
    public static final String Email = "emailKey";
    SharedPreferences sharedpreferences;

    public static final String USER_NAME = "USER_NAME";

    public static final String PASSWORD = "PASSWORD";
    Boolean isInternetPresent = false;
    ConnectionDetector cd;
    RelativeLayout rl_dialoguser;
    View layout12;
    private static final String LOGIN_URL ="http://192.168.43.73/Backend/LoginUser.php";

    private EditText editTextUserName;
    private EditText editTextPassword;
    SessionManager session;

    private Button buttonLogin,buttoncreate;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        session = new SessionManager(getApplicationContext());

        editTextUserName = (EditText) findViewById(R.id.editTextUserName);
        editTextPassword = (EditText) findViewById(R.id.editTextPassword);

        buttonLogin = (Button) findViewById(R.id.button);
        buttoncreate=(Button)findViewById(R.id.button1);



        buttonLogin.setOnClickListener(this);
        buttoncreate.setOnClickListener(this);

        cd = new ConnectionDetector(getApplicationContext());
        isInternetPresent = cd.isConnectingToInternet();
        // check for Internet status
        if (!isInternetPresent) {
            // Internet connection is not present
            // Ask user to connect to Internet
            RelativeLayout rl_back = (RelativeLayout) findViewById(R.id.rl_back);
            if (rl_back == null) {
                Log.d("second", "second");
                rl_dialoguser = (RelativeLayout) findViewById(R.id.rl_infodialog);

                layout12 = getLayoutInflater().inflate(
                        R.layout.connectiondialog, rl_dialoguser, false);

                rl_dialoguser.addView(layout12);
                rl_dialoguser.startAnimation(AnimationUtils.loadAnimation(
                        ActivityLogin.this, R.anim.popup));
                Button btn_yes = (Button) layout12.findViewById(R.id.btn_yes);
                btn_yes.setOnClickListener(new View.OnClickListener() {

                    @Override
                    public void onClick(View v) {
                        // TODO Auto-generated method stub
                        rl_dialoguser.setVisibility(View.GONE);
                    }
                });
            }
            // showAlertDialog(getApplicationContext(),
            // "No Internet Connection",
            // "You don't have internet connection.", false);


        }

    }

    private void reguser() {
        Intent in=new Intent(getApplicationContext(),RegActivity.class);
        startActivity(in);
    }


    private void login(){
        String username = editTextUserName.getText().toString().trim();
        String password = editTextPassword.getText().toString().trim();
        userLogin(username,password);
    }

    private void userLogin(final String username, final String password){
        class UserLoginClass extends AsyncTask<String,Void,String> {
            ProgressDialog loading;
            @Override
            protected void onPreExecute() {
                super.onPreExecute();
                loading = ProgressDialog.show(ActivityLogin.this,"Please Wait",null,true,true);
            }

            @Override
            protected void onPostExecute(String s) {
                super.onPostExecute(s);
                loading.dismiss();
                if(s.equalsIgnoreCase("Login Successful")){
                    session.createLoginSession("USER", "test@gmail.com");

                    Intent intent = new Intent(ActivityLogin.this,MainActivity.class);
                    startActivity(intent);
                }else{
                    Toast.makeText(ActivityLogin.this,s, Toast.LENGTH_LONG).show();
                }
            }

            @Override
            protected String doInBackground(String... params) {
                HashMap<String,String> data = new HashMap<>();
                data.put("username",params[0]);
                data.put("password",params[1]);

                RegisterUserClass ruc = new RegisterUserClass();

                String result = ruc.sendPostRequest(LOGIN_URL,data);

                return result;
            }
        }
        UserLoginClass ulc = new UserLoginClass();
        ulc.execute(username,password);
    }

    @Override
    public void onClick(View v) {

        if(v == buttonLogin){

            if(isValid(editTextUserName.getText().toString())) {
                if (editTextPassword.getText().toString().length()>=8) {
                    login();

                }else{
                    Toast.makeText(getApplicationContext(),"Enter a Valid Password", Toast.LENGTH_LONG).show();
                }
            }else{
                Toast.makeText(getApplicationContext(),"Enter a valid email id", Toast.LENGTH_LONG).show();

            }
        }else {
            reguser();

        }
    }


    public static boolean isValid(String email)
    {
        String expression = "^[\\w\\.-]+@([\\w\\-]+\\.)+[A-Z]{2,4}$";
        CharSequence inputStr = email;
        Pattern pattern = Pattern.compile(expression, Pattern.CASE_INSENSITIVE);
        Matcher matcher = pattern.matcher(inputStr);
        if (matcher.matches())
        {
            return true;
        }
        else{
            return false;
        }
    }

}