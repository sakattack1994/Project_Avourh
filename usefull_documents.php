<?php
if(isset($_FILES["file"]["name"])){
  move_uploaded_file($_FILES["file"]["tmp_name"],$_SERVER['DOCUMENT_ROOT'] .'/myDepartment/myresources/usefull documents/'.$_FILES['file']['name']);
  echo "<script type=\"text/javascript\">";
  echo "$(#".$_POST['doc_category'].").append(<a href=\"/myDepartment/myresources/usefull documents/\"".$_FILES['file']['name']." download>".$_FILES['file']['name']."</a>)";
  echo "</script>";
  echo $_POST['doc_category'];
  echo "$('#'".$_POST['doc_category'].").append('<a href=\"/myDepartment/myresources/usefull documents/\"".$_FILES['file']['name']." download>'".$_FILES['file']['name']."'</a>')";
}
$content="
<div class=\"col-md-9\">
  <div id=\"content\">
   <form action=\"usefull_documents.php\" method=\"POST\" enctype=\"multipart/form-data\">
      <label><h2>Add document:</h2></label>
      <input type=\"file\" name=\"file\" id=\"file\" >
      <label><h2>Category of the document:</h2></label>
      <select name=\"doc_category\" style=\"font-size=25px\">
        <option value=\"Γενικά έντυπα ετήσεων\">Γενικά έντυπα ετήσεων</option>
        <option value=\"Έντυπα Διπλωματικών Εργασιών\">Έντυπα Διπλωματικών Εργασιών</option>
        <option value=\"Έντυπα Διαγραφών Φοιτητή\">Έντυπα Διαγραφών Φοιτητή</option>
        <option value=\"Έντυπα για Μεταπτυχιακές Σπουδές\">Έντυπα για Μεταπτυχιακές Σπουδές</option>
        <option value=\"Έντυπα για Διδακτορικές Σπουδές\">Έντυπα για Διδακτορικές Σπουδές</option>
      </select>
     <input type=\"submit\" class=add_new_button value=\"&#9546;Add document\">
   </form>
    <br>
    <h1>Χρήσιμα Έντυπα</h1>
    <br>
    <p id=\"Γενικά έντυπα ετήσεων\"><strong>Γενικά έντυπα ετήσεων</strong> <br>
    <a href=\"/myDepartment/myresources/usefull documents/Αίτηση_Γενική.doc\" download>Αίτηση Γενική</a><br>
    <a href=\"/myDepartment/myresources/usefull documents/Υπεύθυνη_Δήλωση_Ν._1599.doc\" download>Υπεύθυνη Δήλωση Ν.1599</a><br>
    <a href=\"/myDepartment/myresources/usefull documents/Αίτηση_Αναστολής_Σπουδών.doc\" download>Αίτηση Αναστολής Σπουδών</a><br>
    <a href=\"/myDepartment/myresources/usefull documents/Αίτηση_για_επανέκδοση_πάσου-ταυτότητας_2.doc\" download>Αίτηση Επανέκδοσης Φοιτητικής Ταυτότητας - πάσο</a><br>
    <a href=\"/myDepartment/myresources/usefull documents/Αίτηση_για_ΕΦΘ.doc\" download>Αίτηση για ΕΦΘ</a><br>
    <a href=\"/myDepartment/myresources/usefull documents/Αίτηση_Διπλωματούχου_για_Πιστοποιητικά.doc\" download>Αίτηση Διπλωματούχου για Πιστοποιητικά</a><br>
    <a href=\"/myDepartment/myresources/usefull documents/Αίτηση_για_διόρθωση_βαθμολογίας.doc\" download>Αίτηση για διόρθωση βαθμολογίας</a><br>
    <a href=\"/myDepartment/myresources/usefull documents/Αίτηση_για_προσθήκη_βαθμολογίας.doc\" download>Αίτηση για προσθήκη βαθμολογίας</a></p>
    <br>
    <p id=\"Έντυπα Διπλωματικών Εργασιών\"><strong>Έντυπα Διπλωματικών Εργασιών</strong></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Δήλωση_ΤομέαΕκπν_διπλ.docx\" download>Δήλωση Τομέα Εκπόνησης Διπλωματικής Εργασίας</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Δήλωση_θέματος_Διπλ_εργασίας3.docx\" download>Έντυπο δήλωσης θέματος διπλωματικής</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Αίτηση_αλλαγής___διπλωματικής_1.doc\" download>Αίτηση αλλαγής Διπλωματικής Εργασίας</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Εντυπο_βαθμολόγ_Διπλωμ_Εργασίας.doc\" download>Έντυπο βαθμολόγησης διπλωματικής</a></p>
    <br>
    <p id=\"Έντυπα Διαγραφών Φοιτητή\"><strong>Έντυπα Διαγραφών Φοιτητή</strong></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Δικαιολογητικά_Διαγραφής.doc\" download>Δικαιολογητικά Διαγραφής</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Υπεύθυνη_Δήλωση_Ν._1599.doc\" download>Υπεύθυνη Δήλωση Ν.1599</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Αίτηση_Διαγραφής.doc\" download>Αίτηση Διαγραφής</a></p>
    <br>
    <p id=\"Έντυπα για Μεταπτυχιακές Σπουδές\"><strong>Έντυπα για Μεταπτυχιακές Σπουδές</strong></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Υπεύθυνη_Δήλωση_Ν._1599_για_διαγραφη_μεταπτυχιακου_φοιτητη.docx\" download>Υπεύθυνη Δήλωση Ν. 1599 για διαγραφή μεταπτυχιακού φοιτητή</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Δικαιολογητικά_Διαγραφής_Μεταπτυχιακού_Φοιτητή.docx\" download>Δικαιολογητικά Διαγραφής Μεταπτυχιακού Φοιτητή</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Αίτηση_Διαγραφής_Μεταπτυχιακου_Φοιτητη.docx\" download>Αίτηση Διαγραφής Μεταπτυχιακού Φοιτητή</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/αιτηση_για_εκδοση_πιστοποιητικου_διπλωματουχου_μεταπτυχιακου_φοιτητη.docx\" download>Αίτηση για εκδοση πιστοποιητικού διπλωματούχου μεταπτυχιακού φοιτητή</a></p>
    <br>
    <p id=\"Έντυπα για Διδακτορικές Σπουδές\"><strong>Έντυπα για Διδακτορικές Σπουδές</strong></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Δικαιολογητικα_για_Αναγορευση_2.doc\" download>Δικαιολογητικά για Αναγόρευση</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/αιτηση_για_εκδοση_πιστοποιητικου.docx\" download>Άιτηση για έκδοση πιστοποιητικού</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/αλλαγη_μαθηματος.docx\" download>Αλλαγή μαθήματος</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Αίτηση_Διαγραφής_Διδακτορα.docx\" download>Αίτηση Διαγραφής Διδακτορα</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Δικαιολογητικά_Διαγραφής_Υποψήφιου_Διδακτορα.doc\" download>Δικαιολογητικά Διαγραφής Υποψήφιου Διδακτορα</a></p>
    <p><a href=\"/myDepartment/myresources/usefull documents/Υπεύθυνη_Δήλωση_Ν._1599_για_διαγραφη_υποψηφιου_διδακτορα.doc\" download>Υπεύθυνη Δήλωση Ν.1599 για διαγραφή υποψηφίου διδάκτορα</a></p>
  </div>
</div>
  <div class=\"col-md-3\">
    <div id=\"side_bar\">
  </div>
</div>";
include 'WebPageTemplate.php';
?>
