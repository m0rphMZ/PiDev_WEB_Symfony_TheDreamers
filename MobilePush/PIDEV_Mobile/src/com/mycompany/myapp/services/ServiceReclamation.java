/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.services;

import com.codename1.io.CharArrayReader;
import com.codename1.io.ConnectionRequest;
import com.codename1.io.JSONParser;
import com.codename1.io.NetworkEvent;
import com.codename1.io.NetworkManager;
import com.codename1.l10n.ParseException;
import com.codename1.l10n.SimpleDateFormat;
import com.codename1.ui.events.ActionListener;
import com.mycompany.myapp.entities.Reclamation;
import com.mycompany.myapp.utils.Statics;
import java.io.IOException;
import java.util.ArrayList;
import java.util.Date;
import java.util.List;
import java.util.Map;


/**
 *
 * @author bhk
 */
public class ServiceReclamation {

    public ArrayList<Reclamation> reclamations;

    public static ServiceReclamation instance = null;
    public boolean resultOK;
    private ConnectionRequest req;

    private ServiceReclamation() {
        req = new ConnectionRequest();
    }

    public static ServiceReclamation getInstance() {
        if (instance == null) {
            instance = new ServiceReclamation();
        }
        return instance;
    }

    public boolean addReclamation(Reclamation r, int userId) {

        String name = r.getTitre_rec();
        String type = r.getType();
        String desc = r.getDescription();
        
        String url = Statics.BASE_URL + "/new?titreRec=" + name + "&typeRec=" + type + "&descRec=" + desc + "&userId=" + userId;
//        String url = Statics.BASE_URL + "/new";
//        String url = Statics.BASE_URL + "create/" + status + "/" + name;

        req.setUrl(url);
        req.setPost(true);
        
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                resultOK = req.getResponseCode() == 200; //Code HTTP 200 OK
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return resultOK;
    }
    
    
  
//    public ArrayList<Reclamation> parseReclamations(String jsonText) throws ParseException {
//        try {
//            reclamations = new ArrayList<>();
//            JSONParser j = new JSONParser();
//            Map<String, Object> recListJson
//                    = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
//
//            List<Map<String, Object>> list = (List<Map<String, Object>>) recListJson.get("root");
//            for (Map<String, Object> obj : list) {
//                Reclamation r = new Reclamation();
//                float id = Float.parseFloat(obj.get("id").toString());
//                r.setRec_id((int) id);
//                r.setTitre_rec(obj.get("titre_rec").toString());
//                r.setType(obj.get("type").toString());
//                r.setDescription(obj.get("description").toString());
//                String dateString = obj.get("date_creation").toString();
//                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
//                Date date = dateFormat.parse(dateString);
//                r.setDate_creation(date);
//                reclamations.add(r);
//            }
//
//        } catch (IOException ex) {
//            System.out.println(ex.getMessage());
//        }
//        return reclamations;
//    }
//    
//    
//    
//    public ArrayList<Reclamation> getReclamationsByUserId(int userId) {
//        String url = Statics.RECBYID_URL + "/?userId=" + userId;
//        req.setUrl(url);
//        req.setPost(false);
//        req.addResponseListener(new ActionListener<NetworkEvent>() {
//            @Override
//            public void actionPerformed(NetworkEvent evt) {
//                try {
//                    reclamations = parseReclamations(new String(req.getResponseData()));
//                } catch (ParseException ex) {
//                }
//                req.removeResponseListener(this);
//            }
//        });
//        NetworkManager.getInstance().addToQueueAndWait(req);
//        return reclamations;
//    }


    

    public ArrayList<Reclamation> parseReclamations(String jsonText) {
    try {
        reclamations = new ArrayList<>();
        JSONParser j = new JSONParser();
        Map<String, Object> recsListJson
                = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));

        List<Map<String, Object>> list = (List<Map<String, Object>>) recsListJson.get("root");
        for (Map<String, Object> obj : list) {
            Reclamation r = new Reclamation();
            Object idObj = obj.get("recId");
            if (idObj == null) {
                r.setRec_id(0);
            } else {
                float rec_id = Float.parseFloat(idObj.toString());
                r.setRec_id((int) rec_id);
            }
            if (obj.get("titreRec") == null) {
                r.setTitre_rec("error");
            } else {
                r.setTitre_rec(obj.get("titreRec").toString());
            }
            if (obj.get("type") == null) {
                r.setType("error");
            } else {
                r.setType(obj.get("type").toString());
            }
            if (obj.get("status") == null) {
                r.setStatus("error");
            } else {
                r.setStatus(obj.get("status").toString());
            }
            if (obj.get("description") == null) {
                r.setDescription("error");
            } else {
                r.setDescription(obj.get("description").toString());
            }
            if (obj.get("dateCreation") == null) {
                r.setDate_creation(new Date());
            } else {
                String dateString = obj.get("dateCreation").toString();
                SimpleDateFormat dateFormat = new SimpleDateFormat("yyyy-MM-dd");
                try {
                    Date date = dateFormat.parse(dateString);
                    r.setDate_creation(date);
                } catch (ParseException e) {
                    System.err.println("Error parsing date: " + dateString);
                    r.setDate_creation(new Date());
                }
            }
            reclamations.add(r);
        }

    } catch (IOException ex) {
        System.out.println(ex.getMessage());
    }
    return reclamations;
}


    public ArrayList<Reclamation> getAllRecs(int userId) {
        String url = Statics.RECBYID_URL + "/?userId=" + userId;
        req.setUrl(url);
        req.setPost(false);
        req.addResponseListener(new ActionListener<NetworkEvent>() {
            @Override
            public void actionPerformed(NetworkEvent evt) {
                reclamations = parseReclamations(new String(req.getResponseData()));
                req.removeResponseListener(this);
            }
        });
        NetworkManager.getInstance().addToQueueAndWait(req);
        return reclamations;
    }
}
