/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.ui.Button;
import com.codename1.ui.Form;
import com.codename1.ui.Label;
import com.codename1.ui.layouts.BoxLayout;

/**
 *
 * @author bhk
 */
public class HomeForm extends Form{

    public HomeForm() {
        
        setTitle("Home");
        setLayout(BoxLayout.y());
        
        add(new Label("Choose an option"));
        Button btnAddTask = new Button("Add Reclamation");
        Button btnListTasks = new Button("List Reclamations");
        
        btnAddTask.addActionListener(e-> new AddRecForm(this).show());
//        btnListTasks.addActionListener(e-> new ListReclamationsForm(this).show());
        addAll(btnAddTask,btnListTasks);
        
        
    }
    
    
}
