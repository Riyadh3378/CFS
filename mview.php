<!DOCTYPE html>
<?php
  include_once("connectdb.php");
  include("menu.html");

  $m_id = $_GET['id'];

  $sql = "SELECT * FROM members WHERE id=$m_id";
  $records = mysqli_query($con, $sql) or die('error');
  $mdata = mysqli_fetch_array($records);

  $m_no = $mdata['no'];
  $m_name = $mdata['name'];
  $mf_name = $mdata['father'];
  $mm_name = $mdata['mother'];

  //getting images from server
    foreach (new DirectoryIterator(__DIR__.'/mimages') as $file) {
      if ($file->isFile()) {
    		$path = pathinfo($file);
    		$imgname = $path['filename'];
            if($imgname == $m_id){
            $imgext = $path['extension'];
          }
      }
    }
 ?>
 
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $m_name;?></title>
 	<script language="javascript" type="text/javascript" src='script/pdfmake.min.js'></script>
 	<script language="javascript" type="text/javascript" src='script/vfs_fonts.js'></script>
</head>
<body>
<script language="javascript" type="text/javascript">
	var docDefinition = {
  content: [
  { text :'Companigonj Friends Society', style: ['header','textCen']},
  { text :'Basurhat, Companigonj', style: ['textCen']},
  { text :'Noakhali', style: ['textCen']},
    {
      columns: [
        {
          // auto-sized columns have their widths based on their content
          width: 'auto',
          text: 'First column'
        },
        {
          // star-sized columns fill the remaining space
          // if there's more than one star-column, available width is divided equally
          width: '*',
          text: 'Second column'
        },
        {
          // fixed width
          width: 100,
          text: 'Third column'
        },
        {
          // % width
          width: '20%',
          text: 'Fourth column'
        }
      ],
      // optional space between columns
      columnGap: 10
    },
  ],
  styles: {
     header: {
       fontSize: 22,
       bold: true
     },
     textCen: {
       italic: true,
       alignment: 'center',
     }
   }
};

	// open the PDF in a new window
	pdfMake.createPdf(docDefinition).open({}, window);

	// print the PDF
	pdfMake.createPdf(docDefinition).print();
	
	// download the PDF
	//pdfMake.createPdf(docDefinition).download('optionalName.pdf');
</script>
</body>
</html>
