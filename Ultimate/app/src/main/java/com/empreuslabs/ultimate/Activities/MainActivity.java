package com.empreuslabs.ultimate.Activities;

import android.animation.AnimatorSet;
import android.animation.ObjectAnimator;
import android.app.Activity;
import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.graphics.Bitmap;
import android.graphics.BitmapFactory;
import android.graphics.Typeface;
import android.location.Location;
import android.os.AsyncTask;
import android.os.Build;
import android.os.Bundle;
import android.support.v4.app.ActionBarDrawerToggle;
import android.support.v4.app.ActivityCompat;
import android.support.v4.view.GravityCompat;
import android.support.v4.widget.DrawerLayout;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.view.Window;
import android.view.animation.AnimationUtils;
import android.widget.AdapterView;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.RelativeLayout;
import android.widget.TextView;

import com.empreuslabs.ultimate.R;
import com.empreuslabs.ultimate.getset.Restgetset;
import com.empreuslabs.ultimate.getset.Restgetset1;
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
import java.util.Collections;
import java.util.Comparator;

public class MainActivity extends Activity implements ActivityCompat.OnRequestPermissionsResultCallback{


    ListView list_detail;
    Context context = this;
    EditText edit_search;
    String rating, search;
    static double d;
    static double miles;
    Float rate = 0.0f;
    public static ArrayList<Restgetset> rest;
    ArrayList<Restgetset1> rest1;
    static double latitude;
    static double longitude;

    public static final String MY_PREFS_NAME = "Restaurant";
    // ListView represents Navigation Drawer

    // ActionBarDrawerToggle indicates the presence of Navigation Drawer in the
    // action bar

    ActionBarDrawerToggle mDrawerToggle;
    Button btn_more, btn_map, btn_more1;
    ProgressDialog progressDialog;
    String foodtype;
    String user2;
    View layout12;
    RelativeLayout rl_home;
    String input, map;
    int pos;
    String emailpattern;
    ConnectionDetector cd;
    Boolean isInternetPresent = false;
    AlertDialogManager alert = new AlertDialogManager();
    int MainPosition = 0;
    DrawerLayout mDrawerLayout;
    RelativeLayout rl_dialoguser;
    private String Error = null;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        getWindow().requestFeature(Window.FEATURE_ACTION_BAR);

        setContentView(R.layout.activity_main);


        cd = new ConnectionDetector(getApplicationContext());
        initialize();
        buttonclick();
        drawer();
        isInternetPresent = cd.isConnectingToInternet();
        // check for Internet status
        if (isInternetPresent) {
            emailpattern = "[a-zA-Z0-9._-]+@[a-z]+\\.+[a-z]+";
            // initialize

            Intent iv = getIntent();
            foodtype = iv.getStringExtra("foodname");
            map = iv.getStringExtra("map");
            Log.d("map", "" + map);

            // check data is category page or not
            if (foodtype != null) {
                new getrestaudetail1().execute();
            } else {
                new getrestaudetail().execute();
            }

            // TODO Auto-generated method stub

            try {
                rating = String.valueOf(rate);
            } catch (NumberFormatException e) {
                // TODO: handle exception
            }

            rating = "3";

            edit_search = (EditText) findViewById(R.id.edit_search);
            // search on home page method
            edit_search.addTextChangedListener(new TextWatcher() {

                @Override
                public void onTextChanged(CharSequence s, int start,
                                          int before, int count) {
                    // TODO Auto-generated method stub

                }

                @Override
                public void beforeTextChanged(CharSequence s, int start,
                                              int count, int after) {
                    // TODO Auto-generated method stub

                }

                @Override
                public void afterTextChanged(Editable s) { // TODO
                    // Auto-generated
                    // method stub
                    search = s.toString();
                    if (search.equals("")) {
                        new getrestaudetail().execute();
                        Log.d("search", "" + search);
                    } else {
                        new getrestaudetail1().execute();
                    }

                }
            });
        } else {
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
                        MainActivity.this, R.anim.popup));
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



    private void drawer() {

        mDrawerToggle = new ActionBarDrawerToggle(this, mDrawerLayout,
                R.drawable.logo, R.string.drawer_open,
                R.string.drawer_close) {

            /**
             * Called when drawer is closed
             */
            @Override
            public void onDrawerClosed(View view) {
                // getActionBar().setTitle(mTitle);
                invalidateOptionsMenu();

            }

            /**
             * Called when a drawer is opened
             */
            @Override
            public void onDrawerOpened(View drawerView) {
                // getActionBar().setTitle("Select a river");
                invalidateOptionsMenu();
            }


        };
        // Setting DrawerToggle on DrawerLayout
        mDrawerLayout.setDrawerListener(mDrawerToggle);

        // all linear layout from slider menu
        LinearLayout ll_home = (LinearLayout) findViewById(R.id.ll_home);
        ll_home.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                mDrawerLayout.closeDrawer(GravityCompat.START);
                mDrawerLayout.setVisibility(View.INVISIBLE);
                // new changes
                Intent iv = new Intent(MainActivity.this, MainActivity.class);
                startActivity(iv);
            }
        });

        // category buuton click
        LinearLayout ll_cat = (LinearLayout) findViewById(R.id.ll_cat);
        ll_cat.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                btn_more1.setVisibility(View.INVISIBLE);
                btn_more.setVisibility(View.VISIBLE);
                mDrawerLayout.setVisibility(View.INVISIBLE);
                mDrawerLayout.closeDrawer(GravityCompat.START);
                Intent iv = new Intent(getApplicationContext(), Category.class);
                startActivity(iv);
            }
        });
        

        // special offer button click
        LinearLayout ll_special = (LinearLayout) findViewById(R.id.ll_special);
        ll_special.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                btn_more1.setVisibility(View.INVISIBLE);
                btn_more.setVisibility(View.VISIBLE);
                mDrawerLayout.setVisibility(View.INVISIBLE);
                mDrawerLayout.closeDrawer(GravityCompat.START);
                Intent iv = new Intent(getApplicationContext(), Offer.class);
                startActivity(iv);
            }
        });

        // about us button click
        LinearLayout ll_about = (LinearLayout) findViewById(R.id.ll_about);
        ll_about.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                btn_more1.setVisibility(View.INVISIBLE);
                btn_more.setVisibility(View.VISIBLE);
                mDrawerLayout.setVisibility(View.INVISIBLE);
                mDrawerLayout.closeDrawer(GravityCompat.START);
                Intent iv = new Intent(getApplicationContext(), About.class);
                startActivity(iv);
            }
        });

        // social sharing button click
        LinearLayout ll_social = (LinearLayout) findViewById(R.id.ll_social);
        ll_social.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                btn_more1.setVisibility(View.INVISIBLE);
                btn_more.setVisibility(View.VISIBLE);
                mDrawerLayout.setVisibility(View.INVISIBLE);
                Intent share = new Intent(Intent.ACTION_SEND);
                share.setType("text/plain");

                share.addFlags(Intent.FLAG_ACTIVITY_CLEAR_WHEN_TASK_RESET);
                share.putExtra(Intent.EXTRA_SUBJECT, "Restaurant");

                share.putExtra(
                        Intent.EXTRA_TEXT,
                        "https://play.google.com/store/apps/details?id="
                                + MainActivity.this.getPackageName()
                                + "\n"
                                + "The great advantage of a restaurant is that it's a refuge from home life. ");
                startActivity(Intent.createChooser(share, "Share Link!"));
            }
        });

        // terms and condtion button click
        LinearLayout ll_terms = (LinearLayout) findViewById(R.id.ll_term);
        ll_terms.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                btn_more1.setVisibility(View.INVISIBLE);
                btn_more.setVisibility(View.VISIBLE);
                mDrawerLayout.setVisibility(View.INVISIBLE);
                mDrawerLayout.closeDrawer(GravityCompat.START);
                Intent iv = new Intent(getApplicationContext(),
                        Termcondition.class);
                startActivity(iv);
            }
        });

        // profile button click
        LinearLayout ll_profile = (LinearLayout) findViewById(R.id.ll_profile);
        ll_profile.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                btn_more1.setVisibility(View.INVISIBLE);
                btn_more.setVisibility(View.VISIBLE);
                Intent iv = new Intent(getApplicationContext(),
                        UserProfile.class);
                startActivity(iv);




            }
        });
    }


    private void buttonclick() {
        // TODO Auto-generated method stub
        btn_more = (Button) findViewById(R.id.img_more);

        btn_more1 = (Button) findViewById(R.id.img_more1);
        btn_more1.setVisibility(View.INVISIBLE);

        // drawer open
        btn_more.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                btn_more1.setVisibility(View.VISIBLE);
                btn_more.setVisibility(View.INVISIBLE);
                mDrawerLayout.setVisibility(View.VISIBLE);
                mDrawerLayout.openDrawer(Gravity.LEFT);
            }

        });

        // close drawer
        btn_more1.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub

                // mDrawerLayout.setVisibility(View.VISIBLE);
                btn_more1.setVisibility(View.INVISIBLE);
                btn_more.setVisibility(View.VISIBLE);
                mDrawerLayout.closeDrawer(Gravity.LEFT);
                mDrawerLayout.setVisibility(View.INVISIBLE);
            }

        });
    }


    private void initialize() {
        // TODO Auto-generated method stub
        rl_home = (RelativeLayout) findViewById(R.id.rl_home);
        rest = new ArrayList<Restgetset>();
        rest1 = new ArrayList<Restgetset1>();
        list_detail = (ListView) findViewById(R.id.list_detail);

        mDrawerLayout = (DrawerLayout) findViewById(R.id.drawer_layout);
        mDrawerLayout.setVisibility(View.INVISIBLE);
        mDrawerLayout.setDrawerLockMode(DrawerLayout.LOCK_MODE_LOCKED_CLOSED);
        // btn_fvrts = (Button) findViewById(R.id.btn_fvrts);
        

    }




    public class getrestaudetail extends AsyncTask<Void, Void, Void> {

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(MainActivity.this);
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
                            MainActivity.this, R.anim.popup));
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

                    list_detail = (ListView) findViewById(R.id.list_detail);

                    LazyAdapter lazy = new LazyAdapter(MainActivity.this, rest);
                    lazy.notifyDataSetChanged();

                    list_detail.setAdapter(lazy);

                }
                list_detail.setOnItemClickListener(new AdapterView.OnItemClickListener() {

                    @Override
                    public void onItemClick(AdapterView<?> parent, View view,
                                            int position, long id) {
                        // TODO Auto-generated method stub
                        // Toast.makeText(Home.this, "hi",
                        // Toast.LENGTH_LONG).show();
                        MainPosition = 1;
                        pos = position;


                            ContinueIntent();

                    }
                });
            }

        }

    }


    // getting data for home page(restaurant detail)
    private void getdetailforNearMe() {
        // TODO Auto-generated method stub

        URL hp = null;
        try {
            rest.clear();
            hp = new URL(getString(R.string.liveurl) + "restaurantdetail.php");
            // hp = new
            // URL("http://192.168.1.106/restourant/restaurantdetail.php");
            Log.d("URL", "" + hp);
            URLConnection hpCon = hp.openConnection();
            hpCon.connect();
            InputStream input = hpCon.getInputStream();
            Log.d("input", "" + input);

            BufferedReader r = new BufferedReader(new InputStreamReader(input));

            String x = "";
            x = r.readLine();
            String total = "";

            while (x != null) {
                total += x;
                x = r.readLine();
            }
            Log.d("URL", "" + total);
            JSONObject jObject = new JSONObject(total);
            JSONArray j = jObject.getJSONArray("Restaurant");
            // JSONArray j = new JSONArray(total);

            Log.d("URL1", "" + j);
            for (int i = 0; i < j.length(); i++) {

                JSONObject Obj;
                Obj = j.getJSONObject(i);

                Restgetset temp = new Restgetset();
                temp.setName(Obj.getString("name"));
                temp.setId(Obj.getString("id"));
                temp.setAddress(Obj.getString("address"));
                temp.setRatting(Obj.getString("ratting"));
                temp.setLatitude(Obj.getString("latitude"));
                temp.setLongitude(Obj.getString("longitude"));
                temp.setZipcode(Obj.getString("zipcode"));
                temp.setThubnailimage(Obj.getString("thumbnailimage"));
                temp.setVegtype(Obj.getString("vegtype"));
                // temp.setFoodtype(Obj.getString("foodtype"));
                convertmiles(Obj.getString("latitude"),
                        Obj.getString("longitude"));



                temp.setMiles(miles);
                rest.add(temp);

            }
            // sorting data from miles wise in home page list
            Collections.sort(rest, new Comparator<Restgetset>() {

                @Override
                public int compare(Restgetset lhs, Restgetset rhs) {
                    // TODO Auto-generated method stub
                    return Double.compare(lhs.getMiles(), rhs.getMiles());
                }
            });
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
            e.printStackTrace();
            Error = e.getMessage();
        } catch (NullPointerException e) {
            // TODO: handle exception
            Error = e.getMessage();
        }
    }

    // binding data in listview usind adapter class
    public class LazyAdapter extends BaseAdapter {

        private Activity activity;
        private ArrayList<Restgetset> data;
        private LayoutInflater inflater = null;
        Typeface tf = Typeface.createFromAsset(MainActivity.this.getAssets(),
                "fonts/OpenSans-Regular.ttf");
        private int lastPosition = -1;

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

                vi = inflater.inflate(R.layout.restcell, null);
            }
         /*   //Change in Animation///
             Animation animation = AnimationUtils.loadAnimation(MainActivity.this,
             (position > lastPosition) ? R.anim.listview1
             : R.anim.listview);
             vi.startAnimation(animation);
             lastPosition = position;
          */
            double earthRadius = 6371000; // meters
            double dLat = Math.toRadians(21.2049 - Double.parseDouble(data.get(
                    position).getLatitude()));
            double dLng = Math.toRadians(72.8406 - Double.parseDouble(data.get(
                    position).getLongitude()));
            double a = Math.sin(dLat / 2) * Math.sin(dLat / 2)
                    + Math.cos(Math.toRadians(21.2305574))
                    * Math.cos(Math.toRadians(21.2049)) * Math.sin(dLng / 2)
                    * Math.sin(dLng / 2);
            double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            float dist = (float) (earthRadius * c);
            Log.d("Distance", "" + dist);

            double km = dist / 1000.0;
            Log.d("Distance in KM", "" + km);

            round(km, 0);
            miles = d;

            TextView txt_km = (TextView) vi.findViewById(R.id.txt_km);
            txt_km.setText(data.get(position).getMiles() + " " + "km");
            txt_km.setTypeface(tf);


            TextView txt_rname = (TextView) vi.findViewById(R.id.txt_rest_name);
            txt_rname.setText(data.get(position).getName());
            txt_rname.setTypeface(tf);

            TextView txt_add = (TextView) vi.findViewById(R.id.txt_address);
            txt_add.setText(data.get(position).getAddress()+" "+data.get(position).getZipcode());
            txt_add.setTypeface(tf);

            ImageView img_veg = (ImageView) vi.findViewById(R.id.img_veg);
            ImageView img_nonveg = (ImageView) vi.findViewById(R.id.img_nonveg);
            img_nonveg.setVisibility(View.INVISIBLE);
            img_veg.setVisibility(View.INVISIBLE);
            String veg = data.get(position).getVegtype();
            if (veg.equals("Veg")) {
                img_veg.setVisibility(View.VISIBLE);
                img_veg.setBackgroundResource(R.drawable.vegicon);
            } else if (veg.equals("Nonveg")) {
                img_nonveg.setVisibility(View.VISIBLE);
                img_nonveg.setBackgroundResource(R.drawable.nonvegicon);
            } else {
                img_nonveg.setVisibility(View.VISIBLE);
                img_veg.setVisibility(View.VISIBLE);
                img_nonveg.setBackgroundResource(R.drawable.nonvegicon);
                img_veg.setBackgroundResource(R.drawable.vegicon);
            }

            String image = data.get(position).getThubnailimage();
            Log.d("image", "" + image);

            // new changes
            ImageView programImage = (ImageView)vi.findViewById(R.id.img_restau);
            AnimatorSet set = new AnimatorSet();

            set.playTogether(
                    ObjectAnimator.ofFloat(programImage, "scaleX", 0.0f, 1.0f)
                            .setDuration(1500),
                    ObjectAnimator.ofFloat(programImage, "scaleY", 0.0f, 1.0f)
                            .setDuration(1500));
            set.start();

            programImage.setImageResource(R.drawable.homepagecellimg);
            ImageLoader imgLoader = new ImageLoader(MainActivity.this);
            imgLoader.DisplayImage(getString(R.string.liveurl) + "uploads/" + image, programImage);
            // new DownloadImageTask(programImage)
            // .execute("http://192.168.1.106/restourant/uploads/" + image);

          /*  RatingBar ratb = (RatingBar) vi.findViewById(R.id.rate1);
            ratb.setFocusable(false);
            ratb.setRating(Float.parseFloat(data.get(position).getRatting()));
            ratb.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {

                @Override
                public void onRatingChanged(RatingBar ratingBar, float rating,
                                            boolean fromUser) { // TODO Auto-generated method stub
                    rate = rating;
                    Log.d("rate", "" + rating);
                }

            });     */

            return vi;
        }
    }


    // convert latitude and longitude to km
    public static double round(double value, int places) {
        if (places < 0)
            throw new IllegalArgumentException();

        long factor = (long) Math.pow(10, places);
        value = value * factor;
        long tmp = Math.round(value);
        d = tmp / factor;
        Log.d("temp", "" + d);
        return d;
    }

    // convert km to miles
    public static double convertmiles(String value, String places) {
        Log.d("latitudecurrent", "" + latitude);
        Log.d("longitudecurrent", "" + longitude);
        Log.d("latitudehotel", "" + Double.parseDouble(value));
        Log.d("longitudehotel", "" + Double.parseDouble(places));

        Location selected_location = new Location("locationA");
        selected_location.setLatitude(Double.parseDouble(value));
        selected_location.setLongitude(Double.parseDouble(places));
        Location near_locations = new Location("locationA");
        near_locations.setLatitude(latitude);
        near_locations.setLongitude(longitude);
        double dist = selected_location.distanceTo(near_locations);

        double km = dist / 1000.0;
        Log.d("Distance in KM", "" + km);

        double rounded = (double) Math.round(km * 100) / 100;
        Log.d("rounded", "" + rounded);

        round(rounded, 0);
        miles = d ;

        return miles;
    }

    class DownloadImageTask extends AsyncTask<String, Void, Bitmap> {
        ImageView bmImage;
        Bitmap mIcon11;

        public DownloadImageTask(ImageView bmImage) {
            this.bmImage = bmImage;
            // viewReference = new WeakReference<ImageView>( view );
        }

        @Override
        protected Bitmap doInBackground(String... urls) {
            String urldisplay = urls[0];

            try {
                // BitmapFactory.Options options = new BitmapFactory.Options();
                // options.inSampleSize = 8;
                InputStream in = new URL(urldisplay).openStream();
                mIcon11 = BitmapFactory.decodeStream(in);
                mIcon11 = Bitmap.createScaledBitmap(mIcon11, 72, 55, true);
            } catch (Exception e) {
                Log.e("Error", "" + e.getMessage());
                e.printStackTrace();
            }
            return mIcon11;
        }

        @Override
        protected void onPostExecute(Bitmap result) {
            if (bmImage != null) {
                bmImage.setImageBitmap(result);
            }

        }
    }

    // category search class
    public class getrestaudetail1 extends AsyncTask<Void, Void, Void> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(MainActivity.this);
            progressDialog.setMessage("Loading...");
            progressDialog.setCancelable(true);
            progressDialog.show();
        }

        @Override
        protected Void doInBackground(Void... params) {
            URL hp = null;
            try {
                rest1.clear();
                if (foodtype != null) {
                    hp = new URL(getString(R.string.liveurl)
                            + "restaurantdetail.php?search=" + foodtype);
                    // hp = new URL(
                    // "http://192.168.1.106/restourant/restaurantdetail.php?search="
                    // + foodtype);
                } else {
                    hp = new URL(getString(R.string.liveurl)
                            + "restaurantdetail.php?search=" + search);
                    // hp = new URL(
                    // "http://192.168.1.106/restourant/restaurantdetail.php?search="
                    // + search);
                }

                Log.d("URL", "" + hp);
                URLConnection hpCon = hp.openConnection();
                hpCon.connect();
                InputStream input = hpCon.getInputStream();
                Log.d("input", "" + input);

                BufferedReader r = new BufferedReader(new InputStreamReader(
                        input));

                String x = "";
                x = r.readLine();
                String total = "";

                while (x != null) {
                    total += x;
                    x = r.readLine();
                }
                Log.d("URL", "" + total);
                JSONObject jObject = new JSONObject(total);
                JSONArray j = jObject.getJSONArray("Restaurant");
                // JSONArray j = new JSONArray(total);

                Log.d("URL1", "" + j);
                for (int i = 0; i < j.length(); i++) {

                    JSONObject Obj;
                    Obj = j.getJSONObject(i);

                    Restgetset1 temp = new Restgetset1();
                    String idobj = temp.getId();
                    Log.d("idobj", "" + idobj);

                    temp.setId(Obj.getString("id"));
                    temp.setName(Obj.getString("name"));
                    temp.setLatitude(Obj.getString("latitude"));
                    temp.setLongitude(Obj.getString("longitude"));
                    temp.setAddress(Obj.getString("address"));
                    temp.setRatting(Obj.getString("ratting"));
                    temp.setThumbnailimage(Obj.getString("thumbnailimage"));
                    temp.setVegtype(Obj.getString("vegtype"));

                    convertmiles(Obj.getString("latitude"),
                            Obj.getString("longitude").replace("-", ""));

                    Log.d("dd", "" + miles);
                    temp.setMiles(miles);


                    rest1.add(temp);

                }
                Collections.sort(rest, new Comparator<Restgetset>() {

                    @Override
                    public int compare(Restgetset lhs, Restgetset rhs) {
                        // TODO Auto-generated method stub
                        return Double.compare(lhs.getMiles(), rhs.getMiles());
                    }
                });
            } catch (MalformedURLException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            } catch (IOException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            } catch (JSONException e) {
                // TODO Auto-generated catch block
                e.printStackTrace();
            } catch (NullPointerException e) {
                // TODO: handle exception
            }catch (Exception e) {
                // TODO: handle exception
                e.printStackTrace();
            }

            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            if (progressDialog.isShowing()) {
                progressDialog.dismiss();
            }
            list_detail = (ListView) findViewById(R.id.list_detail);

            LazyAdapter1 lazy = new LazyAdapter1(MainActivity.this, rest1);
            lazy.notifyDataSetChanged();
            list_detail.setAdapter(lazy);

            list_detail.setOnItemClickListener(new AdapterView.OnItemClickListener() {

                @Override
                public void onItemClick(AdapterView<?> parent, View view,
                                        int position, long id) {
                    // TODO Auto-generated method stub
                    // Toast.makeText(Home.this, "hi",
                    // Toast.LENGTH_LONG).show();
                    MainPosition = 2;
                    pos = position;


                        ContinueIntent();

                    // Intent iv = new Intent(MainActivity.this, DetailPage.class);
                    // iv.putExtra("rating", "" +
                    // rest1.get(position).getRatting());
                    // iv.putExtra("name", "" + rest1.get(position).getName());

                    // iv.putExtra("id", "" + rest1.get(position).getId());
                    // startActivity(iv);
                }
            });

        }

        void onPause(){}

    }

    // search category bind in listview
    public class LazyAdapter1 extends BaseAdapter {

        private Activity activity;
        private ArrayList<Restgetset1> data;
        private LayoutInflater inflater = null;
        Typeface tf = Typeface.createFromAsset(MainActivity.this.getAssets(),
                "fonts/OpenSans-Regular.ttf");

        public LazyAdapter1(Activity a, ArrayList<Restgetset1> str) {
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

                vi = inflater.inflate(R.layout.restcell, null);
            }
            // Getsetlist Obj = FileList.get(position);

            double earthRadius = 6371000; // meters
            double dLat = Math.toRadians(21.2049 - Double.parseDouble(data.get(
                    position).getLatitude()));
            double dLng = Math.toRadians(72.8406 - Double.parseDouble(data.get(
                    position).getLongitude()));
            double a = Math.sin(dLat / 2) * Math.sin(dLat / 2)
                    + Math.cos(Math.toRadians(21.2305574))
                    * Math.cos(Math.toRadians(21.2049)) * Math.sin(dLng / 2)
                    * Math.sin(dLng / 2);
            double c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            float dist = (float) (earthRadius * c);
            Log.d("Distance", "" + dist);

            double km = dist / 1000.0;
            Log.d("Distance in KM", "" + km);


            round(km, 0);
            miles = d;

            TextView txt_km = (TextView) vi.findViewById(R.id.txt_km);
            txt_km.setText(data.get(position).getMiles() + " " + "km");
            txt_km.setTypeface(tf);

            TextView txt_rname = (TextView) vi.findViewById(R.id.txt_rest_name);
            txt_rname.setText(data.get(position).getName());
            txt_rname.setTypeface(tf);

            TextView txt_add = (TextView) vi.findViewById(R.id.txt_address);
            txt_add.setText(data.get(position).getAddress() );
            txt_add.setTypeface(tf);

            ImageView img_veg = (ImageView) vi.findViewById(R.id.img_veg);
            ImageView img_nonveg = (ImageView) vi.findViewById(R.id.img_nonveg);
            img_nonveg.setVisibility(View.INVISIBLE);
            img_veg.setVisibility(View.INVISIBLE);
            String veg = data.get(position).getVegtype();
            if (veg.equals("Veg")) {
                img_veg.setVisibility(View.VISIBLE);
                img_veg.setBackgroundResource(R.drawable.vegicon);
            } else if (veg.equals("Nonveg")) {
                img_nonveg.setVisibility(View.VISIBLE);
                img_nonveg.setBackgroundResource(R.drawable.nonvegicon);
            } else {
                img_nonveg.setVisibility(View.VISIBLE);
                img_veg.setVisibility(View.VISIBLE);
                img_nonveg.setBackgroundResource(R.drawable.nonvegicon);
                img_veg.setBackgroundResource(R.drawable.vegicon);
            }

            String image = data.get(position).getThumbnailimage();
            Log.d("image", "" + image);
            ImageView img_restau = (ImageView) vi.findViewById(R.id.img_restau);

            AnimatorSet set = new AnimatorSet();

            set.playTogether(
                    ObjectAnimator.ofFloat(img_restau, "scaleX", 0.0f, 1.0f)
                            .setDuration(1500),
                    ObjectAnimator.ofFloat(img_restau, "scaleY", 0.0f, 1.0f)
                            .setDuration(1500));
            set.start();
            ImageLoader imgLoader = new ImageLoader(MainActivity.this);
            imgLoader.DisplayImage(getString(R.string.liveurl) + "uploads/"
                    + image, (ImageView)vi.findViewById(R.id.img_restau));
            // new DownloadImageTask((ImageView)
            // vi.findViewById(R.id.img_restau))
            // .execute(getString(R.string.liveurl) + "uploads/" + image);

            // new DownloadImageTask((ImageView)
            // vi.findViewById(R.id.img_restau))
            // .execute("http://192.168.1.106/restourant/uploads/" + image);

         /*   RatingBar ratb = (RatingBar) vi.findViewById(R.id.rate1);
            ratb.setFocusable(false);
            ratb.setRating(Float.parseFloat(data.get(position).getRatting()));
            ratb.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {

                @Override
                public void onRatingChanged(RatingBar ratingBar, float rating,
                                            boolean fromUser) { // TODO Auto-generated method stub
                    rate = rating;
                    Log.d("rate", "" + rating);
                }

            });     */

            return vi;
        }
    }








    private void ContinueIntent() {

        //WAITING FOR DETAIL PAGE
        if (MainPosition == 1) {
            Intent iv = new Intent(MainActivity.this, DetailPage.class);
            iv.putExtra("rating", "" + rest.get(pos).getRatting());
            iv.putExtra("name", "" + rest.get(pos).getName());
            // iv.putExtra("foodtype", "" + rest.get(pos).getFoodtype());
            iv.putExtra("id", "" + rest.get(pos).getId());
            startActivity(iv);
        } else if (MainPosition == 2) {
            Intent iv = new Intent(MainActivity.this, DetailPage.class);
            iv.putExtra("rating", "" + rest1.get(pos).getRatting());
            iv.putExtra("name", "" + rest1.get(pos).getName());
            // iv.putExtra("foodtype", "" + rest.get(pos).getFoodtype());
            iv.putExtra("id", "" + rest1.get(pos).getId());
            startActivity(iv);
        }




    }

    @Override
    public void onBackPressed() {

		/*
		 * if (this.mDrawerLayout.isDrawerOpen(GravityCompat.START)) {
		 * this.mDrawerLayout.closeDrawer(GravityCompat.START); // finish();
		 *
		 *
		 * } else { super.onBackPressed();
		 *
		 * }
		 */

        AlertDialog.Builder builder1 = new AlertDialog.Builder(MainActivity.this);
        builder1.setTitle("Quit?");
        builder1.setMessage("Are you sure you want to quit?.");
        builder1.setCancelable(true);
        builder1.setPositiveButton("Yes",
                new DialogInterface.OnClickListener() {
                    @Override
                    public void onClick(DialogInterface dialog, int id) {
                        // Home.this.finish();
                        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.JELLY_BEAN) {
                            finishAffinity();
                        }

                    }
                });
        builder1.setNegativeButton("No", new DialogInterface.OnClickListener() {
            @Override
            public void onClick(DialogInterface dialog, int id) {
                dialog.cancel();
            }
        });

        AlertDialog alert11 = builder1.create();
        alert11.show();

        // super.onBackPressed();

    }


}
