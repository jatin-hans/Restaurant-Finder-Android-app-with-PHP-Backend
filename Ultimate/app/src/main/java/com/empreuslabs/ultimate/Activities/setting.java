package com.empreuslabs.ultimate.Activities;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.content.pm.ActivityInfo;
import android.net.Uri;
import android.os.Bundle;
import android.preference.ListPreference;
import android.preference.Preference;
import android.preference.PreferenceActivity;
import android.preference.PreferenceManager;
import android.util.Log;
import android.widget.Toast;

import com.empreuslabs.ultimate.R;

import java.io.File;
import java.nio.channels.FileChannel;

public class setting extends PreferenceActivity {
    SharedPreferences sharedPreferences;

    Preference contactUs, version, importExport, categoryList1, CurrencyList1;
    ListPreference sortBy, defultCurrency;

    Context context = this;
    File file;
    FileChannel src = null;
    FileChannel dst = null;
    int inAppFlag;
    String email, name, mailid, phone, comment, person, date, time;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);

        addPreferencesFromResource(R.xml.setting);
        setRequestedOrientation(ActivityInfo.SCREEN_ORIENTATION_PORTRAIT);
        sharedPreferences = PreferenceManager.getDefaultSharedPreferences(this);

        getintent();

        openGmail();

    }

    private void getintent() {
        // TODO Auto-generated method stub
        Intent iv = getIntent();
        email = iv.getStringExtra("email");
        Log.d("email", "" + email);
        name = iv.getStringExtra("namec");
        Log.d("name", "" + name);
        mailid = iv.getStringExtra("mailid");
        Log.d("name", "" + mailid);
        phone = iv.getStringExtra("phone");
        Log.d("name", "" + phone);

        comment = iv.getStringExtra("comment");
        Log.d("name", "" + comment);

    }

    private void openGmail() {
        // TODO Auto-generated method stub
        try {

            Intent gmail = new Intent(Intent.ACTION_VIEW);
            gmail.setClassName("com.google.android.gm",
                    "com.google.android.gm.ComposeActivityGmail");
            Uri p= Uri.parse("file:///sdcard/Order/output.txt");
            gmail.putExtra(Intent.EXTRA_EMAIL, new String[] { email });
            gmail.setData(Uri.parse(email));
            gmail.putExtra(Intent.EXTRA_SUBJECT,
                    getString(R.string.app_subject));
            gmail.putExtra(Intent.EXTRA_STREAM,p);
            gmail.setType("text/plain");
            gmail.putExtra(Intent.EXTRA_TEXT, "Name: " + name + "\n"
                    + "Mail id: " + mailid + "\n" + "Contact no: " + phone
                    + "\n" + "Comment : "
                    + comment);
            startActivity(gmail);
        } catch (Exception e) {
            sendEmail();
        }
    }

    private void sendEmail() {
        // TODO Auto-generated method stub
        String recipient = email;
        String subject = getString(R.string.app_subject);
        @SuppressWarnings("unused")
        String body = "";

        String[] recipients = { recipient };
        Intent email = new Intent(Intent.ACTION_SEND);

        email.setType("message/rfc822");

        email.putExtra(Intent.EXTRA_EMAIL, recipients);
        email.putExtra(Intent.EXTRA_SUBJECT, subject);

        try {

            startActivity(Intent.createChooser(email,
                    getString(R.string.email_choose_from_client)));

        } catch (android.content.ActivityNotFoundException ex) {

            Toast.makeText(setting.this, getString(R.string.email_no_client),
                    Toast.LENGTH_LONG).show();

        }
    }

    @Override
    public void onBackPressed() {
        // TODO Auto-generated method stub
        super.onBackPressed();
        Intent iv = new Intent(setting.this, place_order.class);
        startActivity(iv);
    }
}
