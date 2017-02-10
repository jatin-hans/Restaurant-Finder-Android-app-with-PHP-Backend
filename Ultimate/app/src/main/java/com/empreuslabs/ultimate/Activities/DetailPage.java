package com.empreuslabs.ultimate.Activities;

import android.app.Activity;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.graphics.Color;
import android.graphics.Typeface;
import android.net.Uri;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.Environment;
import android.support.design.widget.CollapsingToolbarLayout;
import android.support.v4.view.PagerAdapter;
import android.support.v4.view.ViewPager;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.Gravity;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.View;
import android.view.ViewGroup;
import android.view.animation.AnimationUtils;
import android.widget.AbsListView;
import android.widget.ArrayAdapter;
import android.widget.BaseAdapter;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.ImageView;
import android.widget.LinearLayout;
import android.widget.ListView;
import android.widget.RatingBar;
import android.widget.RelativeLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.empreuslabs.ultimate.R;
import com.empreuslabs.ultimate.getset.Foodtype;
import com.empreuslabs.ultimate.getset.Getsetfav;
import com.empreuslabs.ultimate.getset.Restgetset;
import com.empreuslabs.ultimate.utilities.AlertDialogManager;
import com.empreuslabs.ultimate.utilities.ConnectionDetector;
import com.empreuslabs.ultimate.utilities.DBAdapter;
import com.empreuslabs.ultimate.utilities.ImageLoader;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.io.BufferedReader;
import java.io.File;
import java.io.FileNotFoundException;
import java.io.FileOutputStream;
import java.io.FileWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLConnection;
import java.util.ArrayList;

public class DetailPage extends AppCompatActivity {

    String rating, name, type, id;
    private TextView stickyView;
    //   private ListView listView;
    private View heropagerView;
    private View stickyViewSpacer;
    private View stickyViewSpacer1;
    private int MAX_ROWS = 20;

    private Context mContext;
    Float number;
    ListView list_detail;
    RatingBar rb;
    ArrayList<Restgetset> rest;
    ArrayList<Foodtype> food;
    int start = 0;
    int pos;
    int position;
    Button btn_contact, btn_map, btn_review, btn_share, btn_book, btn_fvrt,
            btn_fvrt1;
    DBAdapter myDbHelpel;
    SQLiteDatabase db;
    Cursor cur = null;
    String id1, name1, address, longitude, latitude;
    ArrayList<Getsetfav> FileList;
    String state, state1, stateid, curlat, curlng;
    public static final String MY_PREFS_NAME = "Restaurant";
    ProgressDialog progressDialog;
    Boolean isInternetPresent = false;
    ConnectionDetector cd;
    View layout12;
    private String Error = null;
    AlertDialogManager alert = new AlertDialogManager();
    int MainPosition = 0;
    String[] separated = null;

    // Image Loader

    private ImageLoader imgLoader;




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.test);
//        getWindow().requestFeature(Window.FEATURE_ACTION_BAR);
//		getActionBar().hide();

        try {
            FileOutputStream fos = openFileOutput("Output.txt", Context.MODE_PRIVATE);
        } catch (FileNotFoundException e) {
            e.printStackTrace();
        }

        android.support.v7.widget.Toolbar toolbar = (android.support.v7.widget.Toolbar) findViewById(R.id.toolbar);

        // Set Collapsing Toolbar layout to the screen
        CollapsingToolbarLayout collapsingToolbar =
                (CollapsingToolbarLayout) findViewById(R.id.collapsing_toolbar);
        ActionBar supportActionBar = getSupportActionBar();

        ArrayList<String> myNewList = new ArrayList<String>();

        stickyView = (TextView) findViewById(R.id.txt_header);
        list_detail = (ListView) findViewById(R.id.list_detail);


        heropagerView= findViewById(R.id.pager);

        /* Inflate list header layout */
        LayoutInflater inflater = (LayoutInflater) getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        View listHeader = inflater.inflate(R.layout.test1, null);
        stickyViewSpacer = listHeader.findViewById(R.id.stickyViewPlaceholder);
        //  stickyViewSpacer1 = listHeader.findViewById(R.id.stickyViewPlaceholder1);
        /* Add list view header */
        list_detail.addHeaderView(listHeader);

        /* Handle list View scroll events */
        list_detail.setOnScrollListener(new AbsListView.OnScrollListener() {
            @Override
            public void onScrollStateChanged(AbsListView view, int scrollState) {
            }
            @Override
            public void onScroll(AbsListView view, int firstVisibleItem, int visibleItemCount, int totalItemCount) {
                /* Check if the first item is already reached to top.*/
                if (list_detail.getFirstVisiblePosition() == 0) {
                    View firstChild = list_detail.getChildAt(0);
                    int topY = 0;
                    if (firstChild != null) {
                        topY = firstChild.getTop();
                    }
                    int heroTopY = stickyViewSpacer.getTop();
                    stickyView.setY(Math.max(0, heroTopY + topY));
                    /* Set the image to scroll half of the amount that of ListView */
                    heropagerView.setY(topY * 0.8f);
                }
            }
        });
        //  Button submit=(Button) findViewById(R.id.btn_submit);

        //  submit.setOnClickListener((View.OnClickListener) this);

        cd = new ConnectionDetector(getApplicationContext());

        isInternetPresent = cd.isConnectingToInternet();
        // check for Internet status
        if (isInternetPresent) {
            // Internet Connection is Present
            // make HTTP requests
            // showAlertDialog(getApplicationContext(), "Internet Connection",
            // "You have internet connection", true);
            CallNewInsertial();
            imgLoader = new ImageLoader(DetailPage.this);
            initialize();
            getintent();

            new getrestaufulldetail().execute();
            new getfoodtypedetail().execute();
        } else {
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
                        DetailPage.this, R.anim.popup));
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
      /*  Button menu = (Button) findViewById(R.id.btn_menu);
        menu.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub
                MainPosition =1;
                pos=position;
                ContinueIntent();
            }
        });*/

    }



    private void getintent() {
        // TODO Auto-generated method stub
        Intent iv = getIntent();
        rating = iv.getStringExtra("rating");
        name = iv.getStringExtra("name");
        type = iv.getStringExtra("foodtype");
        id = iv.getStringExtra("id");
        state1 = iv.getStringExtra("state");
        Log.d("type", "" + type);

        mContext = this;
    }

    private void initialize() {
        // TODO Auto-generated method stub

        FileList = new ArrayList<Getsetfav>();
        rest = new ArrayList<Restgetset>();
        food = new ArrayList<Foodtype>();
        //  rb = (RatingBar) findViewById(R.id.rate1);
    }

    // Image View Flipper

    class CustomPagerAdapter extends PagerAdapter {

        Context mContext;
        LayoutInflater mLayoutInflater;

        public CustomPagerAdapter(Context context) {
            mContext = context;
            mLayoutInflater = (LayoutInflater) mContext
                    .getSystemService(Context.LAYOUT_INFLATER_SERVICE);
        }

        @Override
        public int getCount() {
            return separated.length;
        }

        @Override
        public boolean isViewFromObject(View view, Object object) {
            return view == ((RelativeLayout) object);
        }

        @Override
        public Object instantiateItem(ViewGroup container, int position) {
            View itemView = mLayoutInflater.inflate(R.layout.image_pager_fliper,
                    container, false);

            ImageView imageView = (ImageView) itemView
                    .findViewById(R.id.image_page_fliper);
            imageView.setImageResource(R.drawable.detailpageimg);

            String imageurl = getResources().getString(R.string.liveurl)
                    + "uploads/" + separated[position];
            Log.d("imageurl", imageurl);
            imgLoader.DisplayImage(imageurl, imageView);

            container.addView(itemView);

            return itemView;
        }

        @Override
        public void destroyItem(ViewGroup container, int position, Object object) {
            container.removeView((RelativeLayout) object);
        }
    }

    // class for detail of foodtype
    public class getfoodtypedetail extends AsyncTask<Void, Void, Void> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected Void doInBackground(Void... params) {
            URL hp = null;
            try {

                hp = new URL(getString(R.string.liveurl)
                        + "foodtype.php?value=" + id);
                // hp = new URL(
                // "http://192.168.1.106/restourant/foodtype.php?value="
                // + id);
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
                JSONArray j = jObject.getJSONArray("Foodtype");
                // JSONArray j = new JSONArray(total);

                Log.d("URL1", "" + j);
                for (int i = 0; i < j.length(); i++) {

                    JSONObject Obj;
                    Obj = j.getJSONObject(i);

                    Foodtype temp = new Foodtype();
                    temp.setImage_id(Obj.getString("id"));
                    temp.setTbl_images(Obj.getString("food_type"));
                    temp.setFoodtype(Obj.getString("food_type"));
                    temp.setVegtype(Obj.getString("Vegtype"));
                    temp.setPrice(Obj.getString("price"));
                    temp.setimg(Obj.getString("img"));


                    food.add(temp);
                }

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
            }
            return null;
        }

        @Override
        protected void onPostExecute(Void aVoid) {
            super.onPostExecute(aVoid);
            Log.d("img1111", "img");
            int start = 0;
            Foodtype food12 = food.get(start);
            Typeface tf = Typeface.createFromAsset(DetailPage.this.getAssets(),
                    "fonts/Redressed.ttf");
            String type = food12.getTbl_images();

            final String[] separateddata = type.split(",");

            Log.d("split", "" + (separateddata.length));

            LinearLayout.LayoutParams param = new LinearLayout.LayoutParams(
                    200, 70, 1.0f);
            param.gravity = Gravity.CENTER;

            // programatically add button in horizontal scroll view
            Button[] btn = new Button[separateddata.length];
            for (int i = 0; i < separateddata.length; i++) {
                btn[i] = new Button(getApplicationContext());
                btn[i].setText(separateddata[i].toString());
                btn[i].setTypeface(tf);
                btn[i].setTextColor(Color.parseColor("#ffffff"));

                if (i % 2 == 0) {
                    btn[i].setBackgroundResource(R.drawable.firstfoodbg);
                } else {
                    btn[i].setBackgroundResource(R.drawable.secondfoodbg);
                }

                btn[i].setTextSize(15);

                btn[i].setLayoutParams(param);

                param.setMargins(5, 0, 5, 0);



            }

            list_detail = (ListView) findViewById(R.id.list_detail);

            final LazyAdapter lazy = new LazyAdapter(DetailPage.this, food);
            lazy.notifyDataSetChanged();
            list_detail.setChoiceMode(ListView.CHOICE_MODE_MULTIPLE);
            list_detail.setItemsCanFocus(false);
            list_detail.setAdapter(lazy);
            final ArrayList<String> myNewList = new ArrayList<String>();
            final ArrayList<String> mytotal = new ArrayList<String>();

          /*  list_detail.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                @Override
                public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                    String item=list_detail.getItemAtPosition(position).toString();
                    String itemordered;
                    itemordered = item + " added to list";
                    Toast.makeText(getApplicationContext(), itemordered, Toast.LENGTH_SHORT).show();
                    myNewList.add(item);
                }
            });*/
           /* Button submit=(Button) findViewById(R.id.btn_submit);
            submit.setOnClickListener(new View.OnClickListener() {

                @Override
                public void onClick(View v) {
                    // TODO Auto-generated method stub
                  /*  SparseBooleanArray checked = list_detail.getCheckedItemPositions();
                    ArrayList<String> selectedItems = new ArrayList<String>();
                    for (int i = 0; i < checked.size(); i++) {
                        // Item position in adapter
                        int position = checked.keyAt(i);
                        // Add sport if it is checked i.e.) == TRUE!
                        if (checked.valueAt(i))
                            selectedItems.add((String) lazy.getItem(position));
                    }

                    String[] outputStrArr = new String[selectedItems.size()];

                    for (int i = 0; i < selectedItems.size(); i++) {
                        outputStrArr[i] = selectedItems.get(i);
                    }

                    Intent intent = new Intent(getApplicationContext(),
                            Order.class);

                    // Create a bundle object
            Bundle b = new Bundle();
            b.putStringArray("selectedItems", outputStrArr);

            // Add the bundle to the intent.
            intent.putExtras(b);

            // start the ResultActivity
            startActivity(intent);
/////////////////////////////////////////////
                    setContentView(R.layout.result);
                    ListView selecteditems = (ListView) findViewById(R.id.outputList);
                    ArrayAdapter<String> newadapter = new ArrayAdapter<String>(DetailPage.this, android.R.layout.simple_list_item_1, myNewList);
                    selecteditems.setAdapter(newadapter);
        }
    });*/
        }

    }




    // restaurant full detail class
    public class getrestaufulldetail extends AsyncTask<Void, Void, Void> {
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            progressDialog = new ProgressDialog(DetailPage.this);
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
                            DetailPage.this, R.anim.popup));
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

                }    setdata();
                  /*  list_detail = (ListView) findViewById(R.id.list_detail);

                    LazyAdapter lazy = new LazyAdapter(DetailPage.this, food);
                      lazy.notifyDataSetChanged();

                    list_detail.setAdapter(lazy);*/


            }

        }

    }

    private void setdata() {
        // TODO Auto-generated method stub

        SharedPreferences prefs = getSharedPreferences(MY_PREFS_NAME,
                MODE_PRIVATE);

        if (prefs.getString("android_id", null) != null) {
            state = prefs.getString("android_id", null);

        } else {
            state = "off";
        }

        stateid = prefs.getString("stateid", null);

        final Restgetset temp_Obj3 = rest.get(start);

        // set custom font
        Typeface tf = Typeface.createFromAsset(DetailPage.this.getAssets(),
                "fonts/gautami.ttf");
        Typeface tf1 = Typeface.createFromAsset(DetailPage.this.getAssets(),
                "fonts/OpenSans-Regular.ttf");
        Typeface tf2 = Typeface.createFromAsset(DetailPage.this.getAssets(),
                "fonts/calibri.ttf");
        // rb.setRating(Float.parseFloat(temp_Obj3.getRatting()));



        // on click of favourite button

        TextView txt_header = (TextView) findViewById(R.id.txt_header);
        txt_header.setText(temp_Obj3.getName());
        txt_header.setTypeface(tf);


      /*  TextView txt_phone = (TextView) findViewById(R.id.txt_phone);
        txt_phone.setText(temp_Obj3.getPhone_no());
        txt_phone.setTypeface(tf2);*/

       /* TextView txt_timemf = (TextView) findViewById(R.id.txt_timemf);
        txt_timemf.setText(temp_Obj3.getFoodtype());
        txt_timemf.setTypeface(tf);*/


        String tempimg = temp_Obj3.getImages();
        Log.d("img", "" + tempimg);

        separated = tempimg.split(",");
        Log.d("img123", "" + separated.length);

        CustomPagerAdapter mCustomPagerAdapter = new CustomPagerAdapter(
                DetailPage.this);
        ViewPager mViewPager = (ViewPager) findViewById(R.id.pager);
        mViewPager.setAdapter(mCustomPagerAdapter);

        btn_share = (Button) findViewById(R.id.btn_share);
        btn_share.setOnClickListener(new View.OnClickListener() {

            @Override
            public void onClick(View v) {
                // TODO Auto-generated method stub

                Uri imageUri = Uri.parse("android.resource://"
                        + getPackageName() + "/drawable/" + "download");
                Intent share = new Intent(Intent.ACTION_SEND);
                share.setType("text/plain");
                share.setType("image/jpeg");
                share.addFlags(Intent.FLAG_ACTIVITY_CLEAR_WHEN_TASK_RESET);
                share.putExtra(Intent.EXTRA_SUBJECT, "Restaurant");
                share.putExtra(Intent.EXTRA_STREAM, imageUri);
                share.putExtra(Intent.EXTRA_TEXT,
                        "https://play.google.com/store/apps/details?id="
                                + DetailPage.this.getPackageName() + "\n"
                                + "Email: " + temp_Obj3.getEmail() + "\n"
                                + "Address: " + temp_Obj3.getAddress());
                startActivity(Intent.createChooser(share, "Share Link!"));
            }
        });

        // on click imageview

    }

    private void getdetailforNearMe() {
        // TODO Auto-generated method stub

        URL hp = null;
        try {

            hp = new URL(getString(R.string.liveurl)
                    + "restaurantdetail.php?value=" + id);

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
            Log.d("URLTOTAL", "" + total);
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
                temp.setEmail(Obj.getString("email"));
                temp.setVegtype(Obj.getString("vegtype"));
             //   temp.setFoodtype(Obj.getString("food_type"));
                temp.setTime(Obj.getString("time"));
                temp.setPhone_no(Obj.getString("phone_no"));
                temp.setImages(Obj.getString("images"));
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
            e.printStackTrace();
            Error = e.getMessage();
        } catch (NullPointerException e) {
            // TODO: handle exception
            Error = e.getMessage();
        }
    }


    public class LazyAdapter extends BaseAdapter {

        private Activity activity;
        //  private ArrayList<Restgetset> data;
        private ArrayList<Foodtype> data ;
        final ArrayList<String> myNewList = new ArrayList<String>();
        final ArrayList<Integer> mytotal = new ArrayList<Integer>();
        private LayoutInflater inflater = null;
        private int lastPosition = -1;
        Typeface tf = Typeface.createFromAsset(DetailPage.this.getAssets(),
                "fonts/OpenSans-Regular.ttf");

        public LazyAdapter(Activity a, ArrayList<Foodtype> str) {
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


        public  class ViewHolder{
            public TextView txt_rname;
            public TextView txt_add;
            public CheckBox cbox;

        }
        @Override
        public View getView(final int position, final View convertView, ViewGroup parent) {
            View vi = convertView;
            ViewHolder holder;
            if (convertView == null) {

                vi = inflater.inflate(R.layout.menucell, null);
                holder=new ViewHolder();
                holder.txt_rname=(TextView)vi.findViewById(R.id.txt_rest_name);
                holder.txt_add=(TextView)vi.findViewById(R.id.txt_address);
                holder.cbox=(CheckBox)vi.findViewById(R.id.check) ;
                vi.setTag(holder);
            }

            holder=(ViewHolder)vi.getTag();
             /*  list_detail.setOnItemClickListener(new AdapterView.OnItemClickListener() {
                   @Override
                   public void onItemClick(AdapterView<?> parent, View view, int position, long id) {
                       Foodtype item=(Foodtype) parent.getItemAtPosition(position);
                       String itemordered;
                       itemordered = item + " added to list";
                       Toast.makeText(getApplicationContext(), itemordered, Toast.LENGTH_SHORT).show();
                       myNewList.add(item.toString());
                   }
               });*/
            holder.txt_rname.setText("item "+position);
            holder.cbox.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                    if (isChecked) {
                        String item=data.get(position).getFoodtype();
                        item=item.concat("                                                                  Rs");
                        item=item.concat(data.get(position).getPrice());
                        String Price=data.get(position).getPrice();
                        int myprice= Integer.parseInt(Price);

                        //  String pricetotal;
                        String itemordered;
                        //   pricetotal= Price;
                        itemordered = item + " added to list";
                        Toast.makeText(getApplicationContext(), itemordered, Toast.LENGTH_SHORT).show();
                        myNewList.add(item.toString());

                        mytotal.add(myprice);


                        //   Toast.makeText(getApplicationContext(), sum, Toast.LENGTH_SHORT).show();
                    }
                }
            });
            Button submit=(Button) findViewById(R.id.btn_submit);
            submit.setOnClickListener(new View.OnClickListener() {

                @Override
                public void onClick(View v) {
                    // TODO Auto-generated method stub

                    int totalamount;
                    setContentView(R.layout.test3);


                    ListView selecteditems = (ListView) findViewById(R.id.outputList);
                    ListView selecteditems1 = (ListView) findViewById(R.id.outputList1);

                    TextView grandtotal = (TextView) findViewById(R.id.textprice);
                    // final CustomAdapter lazy1= new LazyAdapter(DetailPage.this, myNewList);
                    // lazy.notifyDataSetChanged();
                    ArrayAdapter<String> newadapter = new ArrayAdapter<String>(DetailPage.this, android.R.layout.simple_list_item_1, myNewList);
                    selecteditems.setAdapter(newadapter);
                    ArrayAdapter<Integer> newadapter1 = new ArrayAdapter<Integer>(DetailPage.this, android.R.layout.simple_list_item_1, mytotal);
                    selecteditems1.setAdapter(newadapter1);
                    int sum = 0;
                    for (int d : mytotal) {
                        sum = sum + d;

                    }

                    grandtotal.setText("Rs "+String.valueOf(sum));


                    final Button plc_order=(Button)findViewById(R.id.btn_order);
                    plc_order.setOnClickListener(new View.OnClickListener() {
                        @Override
                        public void onClick(View v) {
                          try {
                              File root = new File(Environment.getExternalStorageDirectory()+File.separator, "Order");
                              if (!root.exists())
                              {
                                  root.mkdirs();
                              }
                              File gpxfile = new File(root, "output.txt");


                              FileWriter writer = new FileWriter(gpxfile);


                              for (String str : myNewList) {
                                  writer.write(str);
                                  writer.append('\n');
                              }
                              writer.close();
                          }catch (Exception e){
                              e.printStackTrace();
                          }
                         final Restgetset temp_obj3=rest.get(start);
                        Intent in=new Intent(DetailPage.this,place_order.class);
                            in.putExtra("email",""+temp_obj3.getEmail());
                            startActivity(in);

                        }
                    });

                }
            });
            //   holder.txt_rname.setText("item "+position);

            TextView txt_rname = (TextView) vi.findViewById(R.id.txt_rest_name);
            txt_rname.setText(data.get(position).getFoodtype());
            txt_rname.setTypeface(tf);

            TextView txt_add = (TextView) vi.findViewById(R.id.txt_address);
            txt_add.setText("Rs "+ data.get(position).getPrice());
            txt_add.setTypeface(tf);


            String image = data.get(position).getimg().replace(" ","%20");
            Log.d("image", "" + image);

            // new changes
            ImageView programImage = (ImageView) vi
                    .findViewById(R.id.img_restau);
            // AnimatorSet set = new AnimatorSet();

          /*  set.playTogether(
                    ObjectAnimator.ofFloat(programImage, "scaleX", 0.0f, 1.0f)
                            .setDuration(1500),
                    ObjectAnimator.ofFloat(programImage, "scaleY", 0.0f, 1.0f)
                            .setDuration(1500));
            set.start();*/

            programImage.setImageResource(R.drawable.homepagecellimg);
            ImageLoader imgLoader = new ImageLoader(DetailPage.this);
            imgLoader.DisplayImage(getString(R.string.liveurl) + "uploads/category/"
                    + image, programImage);

            // new DownloadImageTask(programImage)
            // .execute("http://192.168.0.102/restourant/uploads/" + image);


            return vi;

        }

    }


    private void CallNewInsertial() {
        cd = new ConnectionDetector(DetailPage.this);

        if (!cd.isConnectingToInternet()) {
            alert.showAlertDialog(DetailPage.this, "Internet Connection Error",
                    "Please connect to working Internet connection", false);
            return;
        } else {
            //ContinueIntent();
        }
    }



    private void ContinueIntent() {
        Restgetset temp_Obj3= rest.get(pos);
        if (MainPosition == 1) {
            Intent iv = new Intent(DetailPage.this,Menu.class);
            iv.putExtra("id", "" + temp_Obj3.getId());
            iv.putExtra("rating", "" +temp_Obj3.getRatting());
            iv.putExtra("name", "" +temp_Obj3.getName());
            iv.putExtra("foodtype", "" + temp_Obj3.getFoodtype());
            startActivity(iv);

        } else if (MainPosition == 2) {
            Intent iv = new Intent(DetailPage.this, MainActivity.class);
            iv.putExtra("nm", "" + temp_Obj3.getName());
            iv.putExtra("ad", "" + temp_Obj3.getAddress());
            iv.putExtra("id", "" + temp_Obj3.getId());
            iv.putExtra("foodtype", "" + temp_Obj3.getFoodtype());
            iv.putExtra("rate", "" + rating);
            startActivity(iv);
        } else if (MainPosition == 3) {

        }
    }



    //////End of Activity///////
}

