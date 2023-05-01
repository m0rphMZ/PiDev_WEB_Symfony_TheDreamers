/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package com.mycompany.myapp.gui;

import com.codename1.components.ImageViewer;
import com.codename1.l10n.SimpleDateFormat;
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
import com.mycompany.myapp.services.ServiceReclamation;
import java.io.IOException;
import java.util.ArrayList;

/**
 *
 * @author bhk
 */
public class ListReclamationsForm extends Form {
    
    public ListReclamationsForm(Form previous, int userId) {
        setTitle("List Reclamations");
        setLayout(BoxLayout.y());

        ArrayList<Reclamation> reclamations = ServiceReclamation.getInstance().getAllRecs(userId);
        for (Reclamation r : reclamations) {
            addElement(r);
        }

        getToolbar().addMaterialCommandToLeftBar("", FontImage.MATERIAL_ARROW_BACK, e -> previous.showBack());

    }

   public void addElement(Reclamation reclamation) {
    Container c = new Container(BoxLayout.y());
    c.setUIID("ReclamationContainer");

    Label lblRecId = new Label("# " + String.valueOf(reclamation.getRec_id()));
    lblRecId.setUIID("ReclamationIdLabel");

    Label lblTitre = new Label("Title:");
    lblTitre.setUIID("ReclamationLabel");

    Label lblTitreValue = new Label(reclamation.getTitre_rec());
    lblTitreValue.setUIID("ReclamationValueLabel");

    Label lblType = new Label("Type:");
    lblType.setUIID("ReclamationLabel");

    Label lblTypeValue = new Label(reclamation.getType());
    lblTypeValue.setUIID("ReclamationValueLabel");

    Label lblDescription = new Label("Description:");
    lblDescription.setUIID("ReclamationLabel");

    Label lblDescriptionValue = new Label(reclamation.getDescription());
    lblDescriptionValue.setUIID("ReclamationValueLabel");

    SimpleDateFormat formatter = new SimpleDateFormat("dd/MM/yyyy");
    String dateString = formatter.format(reclamation.getDate_creation());

    Label lblDate = new Label("Date:");
    lblDate.setUIID("ReclamationLabel");

    Label lblDateValue = new Label(dateString);
    lblDateValue.setUIID("ReclamationValueLabel");

    Label lblEtat = new Label("Status:");
    lblEtat.setUIID("ReclamationLabel");

    Label lblEtatValue = new Label(reclamation.getStatus());
    lblEtatValue.setUIID("ReclamationValueLabel");

    // Set font style for labels
    Font boldFont = Font.createSystemFont(Font.FACE_SYSTEM, Font.STYLE_BOLD, Font.SIZE_MEDIUM);
    lblRecId.getUnselectedStyle().setFont(boldFont);
    lblTitre.getUnselectedStyle().setFont(boldFont);
    lblType.getUnselectedStyle().setFont(boldFont);
    lblDescription.getUnselectedStyle().setFont(boldFont);
    lblDate.getUnselectedStyle().setFont(boldFont);
    lblEtat.getUnselectedStyle().setFont(boldFont);

    // Set font style for label values
    Font normalFont = Font.createSystemFont(Font.FACE_SYSTEM, Font.STYLE_PLAIN, Font.SIZE_MEDIUM);
    lblTitreValue.getUnselectedStyle().setFont(normalFont);
    lblTypeValue.getUnselectedStyle().setFont(normalFont);
    lblDescriptionValue.getUnselectedStyle().setFont(normalFont);
    lblDateValue.getUnselectedStyle().setFont(normalFont);
    lblEtatValue.getUnselectedStyle().setFont(normalFont);

    Container idAndTitle = new Container(BoxLayout.x());
    idAndTitle.setUIID("ReclamationContent");

    Container content = new Container(BoxLayout.y());
    content.setUIID("ReclamationContent");

    idAndTitle.addAll(lblRecId, lblTitre, lblTitreValue);

    content.addAll(idAndTitle, lblType, lblTypeValue, lblDescription, lblDescriptionValue, lblDate, lblDateValue, lblEtat, lblEtatValue);
    content.getAllStyles().setMarginTop(5);

    c.addAll(content);

    add(c);
}



    

}
