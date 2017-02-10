package com.empreuslabs.ultimate.Activities;

import android.app.Activity;
import android.app.DatePickerDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.PopupMenu;

import com.empreuslabs.ultimate.R;

import java.util.Calendar;

public class place_order extends Activity {

    EditText edt_name, edt_email, edt_phone, edt_comments;
    Button btn_order, btn_plus, btn_minus, btn_number, btn_date, btn_time;
    String name, email, phone, comment;
    int value = 0;
    private Calendar activeDate;
    private Calendar currentDate;
    String emailhotel, contact;
    PopupMenu popup;



    @Override
    protected void onCreate(Bundle savedInstanceState) {



        super.onCreate(savedInstanceState);
        getWindow().requestFeature(Window.FEATURE_ACTION_BAR);
        setContentView(R.layout.activity_order);

        Gettingintent();
        initialize();
        buttonclick();

    }

    private void initialize() {
        // TODO Auto-generated method stub
        // initialize
        edt_name = (EditText) findViewById(R.id.edt_name);
        edt_email = (EditText) findViewById(R.id.edt_mail);
        edt_phone = (EditText) findViewById(R.id.edt_phone);
        edt_comments = (EditText) findViewById(R.id.edt_comment);


        Calendar c = Calendar.getInstance();
        int hour1 = c.get(Calendar.HOUR_OF_DAY);
        int minute1 = c.get(Calendar.MINUTE);
        int mYear1 = c.get(Calendar.YEAR);
        int mMonth1 = c.get(Calendar.MONTH);
        int mDay1 = c.get(Calendar.DAY_OF_MONTH);
        btn_order = (Button) findViewById(R.id.btn_order);
    }

    private void Gettingintent() {
        // TODO Auto-generated method stub
        // getting data from another page

        Intent iv = getIntent();
        emailhotel = iv.getStringExtra("email");
        contact = iv.getStringExtra("contact");
        Log.d("emailbook", "" + emailhotel);
    }

    private void buttonclick() {
        // TODO Auto-generated method stub
        // date picker



        // email validation(regular expression)
        final String emailPattern = "[a-zA-Z0-9._-]+@[a-z]+\\.+[a-z]+";

        // on click order button(Mail or Message)
        btn_order.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                name = edt_name.getText().toString();
                email = edt_email.getText().toString();
                phone = edt_phone.getText().toString();
                comment = edt_comments.getText().toString();

                // validation
                if (email.matches(emailPattern) && email.length() > 0) {

                } else {
                    edt_email.setError("Enter valid email address");
                }

                if (name.equals("")) {
                    edt_name.setError("Enter Name");
                } else if (email.equals("")) {

                    edt_email.setError("Enter Email Address");
                } else if (phone.equals("")) {
                    edt_phone.setError("Enter at least 10 digit mobile no");
                } else{

                                    Intent iv = new Intent(place_order.this,
                                            setting.class);
                                    iv.putExtra("email", "" + emailhotel);
                                    iv.putExtra("namec", "" + name);
                                    iv.putExtra("mailid", "" + email);
                                    iv.putExtra("phone", "" + phone);
                                    iv.putExtra("comment", "" + comment);

                                    startActivity(iv);



                }

            }

        });
    }

    // date picker class
    class mDateSetListener implements DatePickerDialog.OnDateSetListener {

        @Override
        public void onDateSet(DatePicker view, int year, int monthOfYear,
                              int dayOfMonth) {
            // TODO Auto-generated method stub

            int mYear = year;
            int mMonth = monthOfYear;
            int mDay = dayOfMonth;
            btn_date.setText(new StringBuilder()
                    // Month is 0 based so add 1
                    .append(mMonth + 1).append("/").append(mDay).append("/")
                    .append(mYear).append(" "));

        }
    }


}
