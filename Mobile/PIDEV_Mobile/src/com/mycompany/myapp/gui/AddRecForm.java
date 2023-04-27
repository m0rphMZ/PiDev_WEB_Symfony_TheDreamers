/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.ui.Button;
import com.codename1.ui.CheckBox;
import com.codename1.ui.Command;
import com.codename1.ui.Dialog;
import com.codename1.ui.FontImage;
import com.codename1.ui.Form;
import com.codename1.ui.TextField;
import com.codename1.ui.events.ActionEvent;
import com.codename1.ui.events.ActionListener;
import com.codename1.ui.layouts.BoxLayout;
import com.mycompany.myapp.entities.Task;
import com.mycompany.myapp.entities.Reclamation;
import com.mycompany.myapp.services.ServiceReclamation;
import java.util.Date;

/**
 *
 * @author bhk
 */
public class AddRecForm extends Form{

    public AddRecForm(Form previous) {
        setTitle("Add a new Rec");
        setLayout(BoxLayout.y());
        
        TextField recName = new TextField("","Rec Name");
        TextField recType = new TextField("","Rec Type");
        TextField recDesc = new TextField("","Rec Desc");
        Button btnValider = new Button("Add Rec");
        
//        TextField tfName = new TextField("","TaskName");
//        CheckBox cbStatus = new CheckBox("Status");
//        Button btnValider = new Button("Add task");

            btnValider.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent evt) {
                if ((recName.getText().length()==0))
                    Dialog.show("Alert", "Please fill all the fields", new Command("OK"));
                else
                {
                    try {
                        Reclamation r = new Reclamation();
                        
                        r.setTitre_rec(recName.getText());
                        r.setType(recType.getText());
                        r.setDescription(recDesc.getText());
                        r.setDate_creation(new Date());
                        
                        
                         int userId = 29;
        

                        if( ServiceReclamation.getInstance().addReclamation(r, userId))
                        {
                           Dialog.show("Success","Connection accepted",new Command("OK"));
                        }else
                            Dialog.show("ERROR", "Server error", new Command("OK"));
                    } catch (NumberFormatException e) {
                        Dialog.show("ERROR", "Status must be a number", new Command("OK"));
                    }
                    
                }
                
                
            }
        });
        
//        btnValider.addActionListener(new ActionListener() {
//            @Override
//            public void actionPerformed(ActionEvent evt) {
//                if ((tfName.getText().length()==0))
//                    Dialog.show("Alert", "Please fill all the fields", new Command("OK"));
//                else
//                {
//                    try {
//                        int status=0;
//                        if(cbStatus.isSelected())
//                            status=1;
//                        Task t = new Task(status, tfName.getText().toString());
//                        if( ServiceTask.getInstance().addTask(t))
//                        {
//                           Dialog.show("Success","Connection accepted",new Command("OK"));
//                        }else
//                            Dialog.show("ERROR", "Server error", new Command("OK"));
//                    } catch (NumberFormatException e) {
//                        Dialog.show("ERROR", "Status must be a number", new Command("OK"));
//                    }
//                    
//                }
//                
//                
//            }
//        });
        
        addAll(recName,recType,recDesc,btnValider);
        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK, e-> previous.showBack());
                
    }
    
    
}
