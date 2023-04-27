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
import com.codename1.ui.events.ActionListener;
import com.mycompany.myapp.entities.Reclamation;
import com.mycompany.myapp.entities.Task;
import com.mycompany.myapp.utils.Statics;
import java.io.IOException;
import java.util.ArrayList;
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

//    public ArrayList<Task> parseReclamations(String jsonText) {
//        try {
//            reclamations = new ArrayList<>();
//            JSONParser j = new JSONParser();
//            Map<String, Object> tasksListJson
//                    = j.parseJSON(new CharArrayReader(jsonText.toCharArray()));
//
//            List<Map<String, Object>> list = (List<Map<String, Object>>) tasksListJson.get("root");
//            for (Map<String, Object> obj : list) {
//                Task t = new Task();
//                float id = Float.parseFloat(obj.get("id").toString());
//                t.setId((int) id);
//                t.setStatus(((int) Float.parseFloat(obj.get("status").toString())));
//                if (obj.get("name") == null) {
//                    r.setName("null");
//                } else {
//                    r.setName(obj.get("name").toString());
//                }
//                reclamations.add(r);
//            }
//
//        } catch (IOException ex) {
//            System.out.println(ex.getMessage());
//        }
//        return tasks;
//    }
//
//    public ArrayList<Task> getAllTasks() {
//        String url = Statics.BASE_URL + "get/";
//        req.setUrl(url);
//        req.setPost(false);
//        req.addResponseListener(new ActionListener<NetworkEvent>() {
//            @Override
//            public void actionPerformed(NetworkEvent evt) {
//                tasks = parseTasks(new String(req.getResponseData()));
//                req.removeResponseListener(this);
//            }
//        });
//        NetworkManager.getInstance().addToQueueAndWait(req);
//        return tasks;
//    }
}
