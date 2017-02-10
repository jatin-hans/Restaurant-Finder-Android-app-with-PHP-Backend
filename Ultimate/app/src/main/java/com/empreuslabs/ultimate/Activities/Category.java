package com.empreuslabs.ultimate.Activities;

import android.animation.AnimatorSet;
import android.animation.ObjectAnimator;
import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.graphics.Typeface;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.AnimationUtils;
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.ImageView;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.empreuslabs.ultimate.R;
import com.empreuslabs.ultimate.getset.Restgetset;
import com.empreuslabs.ultimate.utilities.AlertDialogManager;
import com.empreuslabs.ultimate.utilities.ConnectionDetector;
import com.empreuslabs.ultimate.utilities.ImageLoader;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;

public class Category extends AppCompatActivity {

    ListView list_category;
    ProgressDialog progressDialog;
    ArrayList<Restgetset> rest;
    Boolean isInternetPresent = false;
    ConnectionDetector cd;
    View layout12;
    private String Error = null;
    boolean interstitialCanceled;
    AlertDialogManager alert = new AlertDialogManager();
    int MainPosition = 0;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_category);

        cd = new ConnectionDetector(getApplicationContext());

        isInternetPresent = cd.isConnectingToInternet();
        // check for Internet status
        if (isInternetPresent) {
            Initialize();
        }else {
            // Internet connection is not present
            // Ask user to connect to Internet
            RelativeLayout rl_back = (RelativeLayout) findViewById(R.id.rl_back);
            if (rl_back == null) {
                Log.d("second", "second");
                RelativeLayout rl_dialoguser = (RelativeLayout) findViewById(R.id.rl_infodialog);

                layout12 = getLayoutInflater().inflate(
                        R.layout.connectiondialog, rl_dialoguser, false);

                rl_dialoguser.addView(layout12);
                rl_dialoguser.startAnimation(AnimationUtils.loadAnimation(
                        Category.this, R.anim.popup));
                Button btn_yes = (Button) layout12.findViewById(R.id.btn_yes);
                btn_yes.setOnClickListener(new View.OnClickListener() {

                    @Override
                    public void onClick(View v) {
                        // TODO Auto-generated method stub
                        finish();
                    }
                });
            }
            // showAlertDialog(getApplicationContext(),
            // "No Internet Connection",
            // "You don't have internet connection.", false);

        }

    }

    private void Initialize() {
        // TODO Auto-generated method stub
        // Initialize
        rest = new ArrayList<Restgetset>();
        new getcategorydetail().execute();
    }


    // category class
    public class getcategorydetail extends AsyncTask<Void, Void, Void> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(Category.this);
            progressDialog.setMessage("Loading...");
            progressDialog.setCancelable(true);
            progressDialog.show();
        }

        @Override
        protected Void doInBackground(Void... params) {
            getdetailforNearMe();
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            if (Error != null) {
                RelativeLayout rl_back = (RelativeLayout) findViewById(R.id.rl_back);
                if (rl_back == null) {
                    Log.d("second", "second");
                    RelativeLayout rl_dialoguser = (RelativeLayout) findViewById(R.id.rl_infodialog);

                    layout12 = getLayoutInflater().inflate(
                            R.layout.json_dilaog, rl_dialoguser, false);

                    rl_dialoguser.addView(layout12);
                    rl_dialoguser.startAnimation(AnimationUtils.loadAnimation(
                            Category.this, R.anim.popup));
                    Button btn_yes = (Button) layout12
                            .findViewById(R.id.btn_yes);
                    btn_yes.setOnClickListener(new View.OnClickListener() {

                        @Override
                        public void onClick(View v) {
                            // TODO Auto-generated method stub
                            finish();
                        }
                    });
                }
            } else {
                if (progressDialog.isShowing()) {
                    progressDialog.dismiss();

                    list_category = (ListView) findViewById(R.id.list_detail);

                    LazyAdapter lazy = new LazyAdapter(Category.this, rest);
                    list_category.setAdapter(lazy);

                    list_category
                            .setOnItemClickListener(new AdapterView.OnItemClickListener() {

                                @Override
                                public void onItemClick(AdapterView<?> parent,
                                                        View view, int position, long id) {
                                    // TODO Auto-generated method stub
                                    MainPosition = position;
                                    ContinueIntent();

                                }
                            });

                }
            }

        }
    }

    // getting data from category json url
    private void getdetailforNearMe() {
        // TODO Auto-generated method stub

        URL hp = null;
        try {

            hp = new URL(
                    getString(R.string.liveurl)+"foodcategory.php");

            Log.d("URL", "" + hp);
            URLConnection hpCon = hp.openConnection();
            hpCon.connect();
            InputStream input = hpCon.getInputStream();

            BufferedReader r = new BufferedReader(new InputStreamReader(input));

            String x = "";
            x = r.readLine();
            String total = "";

            while (x != null) {
                total += x;
                x = r.readLine();
            }
            Log.d("UR1L", "" + total);

            JSONArray j = new JSONArray(total);

            Log.d("URL1", "" + j.length());
            for (int i = 0; i < j.length(); i++) {

                JSONObject Obj;
                Obj = j.getJSONObject(i);
                Log.d("URL1", "" + i);
                Restgetset temp = new Restgetset();
                temp.setTitle(Obj.getString("name"));
                temp.setImage(Obj.getString("image"));
                Log.d("URL1", "" + Obj.getString("name"));
                rest.add(temp);
            }

        } catch (MalformedURLException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
            Error = e.getMessage();
        } catch (IOException e) {
            // TODO Auto-generated catch block
            e.printStackTrace();
            Error = e.getMessage();
        } catch (JSONException e) {
            // TODO Auto-generated catch block
            Error = e.getMessage();
            e.printStackTrace();
        } catch (NullPointerException e) {
            // TODO: handle exception
            Error = e.getMessage();
        }
    }

    public class LazyAdapter extends BaseAdapter {

        private Activity activity;
        private ArrayList<Restgetset> data;
        private LayoutInflater inflater = null;
        Typeface tf2 = Typeface.createFromAsset(Category.this.getAssets(),
                "fonts/calibri.ttf");

        public LazyAdapter(Activity a, ArrayList<Restgetset> str) {
            activity = a;
            data = str;
            inflater = (LayoutInflater) activity
                    .getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        @Override
        public int getCount() {
            return data.size();
        }

        @Override
        public Object getItem(int position) {
            return position;
        }

        @Override
        public long getItemId(int position) {
            return position;
        }

        @Override
        public View getView(int position, View convertView, ViewGroup parent) {
            View vi = convertView;

            if (convertView == null) {

                vi = inflater.inflate(R.layout.cellcat, null);
            }

            TextView txt_name = (TextView) vi.findViewById(R.id.txt_cat);
            txt_name.setText(data.get(position).getTitle());
            txt_name.setTypeface(tf2);

            String image = data.get(position).getImage().replace(" ","%20");
            Log.d("image", "" + image);

            ImageView img_cat = (ImageView) vi.findViewById(R.id.img_cat);
            img_cat.setImageResource(R.drawable.ctgimg);
            AnimatorSet set = new AnimatorSet();

            set.playTogether(
                    ObjectAnimator.ofFloat(img_cat, "scaleX", 0.0f, 1.0f)
                            .setDuration(1500),
                    ObjectAnimator.ofFloat(img_cat, "scaleY", 0.0f, 1.0f)
                            .setDuration(1500));
            set.start();
            ImageLoader imgLoader = new ImageLoader(Category.this);
            imgLoader.DisplayImage(getString(R.string.liveurl) + "uploads/category/"
                    + image, img_cat);
            return vi;
        }
    }

    private void ContinueIntent() {
        Intent iv = new Intent(Category.this, MainActivity.class);
        iv.putExtra("foodname", "" + rest.get(MainPosition).getTitle());
        startActivity(iv);
    }


}
