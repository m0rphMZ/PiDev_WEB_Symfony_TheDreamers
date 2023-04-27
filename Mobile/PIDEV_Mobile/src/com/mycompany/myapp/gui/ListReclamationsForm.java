/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.components.ImageViewer;
import com.codename1.ui.CheckBox;
import com.codename1.ui.Component;
import com.codename1.ui.Container;
import com.codename1.ui.Font;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.IconHolder;
import com.codename1.ui.Image;
import com.codename1.ui.Label;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.myapp.entities.Reclamation;
import com.mycompany.myapp.entities.Task;
import com.mycompany.myapp.services.ServiceReclamation;
import java.io.IOException;
import java.util.ArrayList;

/**
 *
 * @author bhk
 */
public class ListReclamationsForm extends Form {

//    public ListReclamationsForm(Form previous) {
//        setTitle("List Reclamations");
//        setLayout(BoxLayout.y());
//
//        /*SpanLabel sp = new SpanLabel();
//        sp.setText(ServiceTask.getInstance().getAllTasks().toString());
//        add(sp);
//         */
//        ArrayList<Reclamation> reclamations = ServiceReclamation.getInstance().getAllTasks();
//        for (Reclamation r : reclamations) {
//            addElement(r);
//        }
//
//        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());
//
//    }
//
//    public void addElement(Task task) {
//
//        CheckBox cb = new CheckBox(task.getName());
//        cb.setEnabled(false);
//        if (task.getStatus() == 1) {
//            cb.setSelected(true);
//        }
//
//        add(cb);
//
//    }

}
