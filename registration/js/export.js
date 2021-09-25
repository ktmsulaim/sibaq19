$(function(){
	$("table").tableExport({

	  // Displays table headers (th or td elements) in the <thead>
	  headers: true,                    

	  // Displays table footers (th or td elements) in the <tfoot>    
	  footers: true, 

	  // Filetype(s) for the export
	  formats: ["xls", "csv"],           

	  // Filename for the downloaded file
	  fileName: "Registered_stud",                         

	  // Style buttons using bootstrap framework  
	  bootstrap: false,

	  // Automatically generates the built-in export buttons for each of the specified formats   
	  exportButtons: true,                          

	  // Position of the caption element relative to table
	  position: "top",                   

	  // (Number, Number[]), Row indices to exclude from the exported file(s)
	  ignoreRows: null,                             

	  // (Number, Number[]), column indices to exclude from the exported file(s)              
	  ignoreCols: null,                   

	  // Removes all leading/trailing newlines, spaces, and tabs from cell text in the exported file(s)     
	  trimWhitespace: false         

	});
	
	$('.xls').attr({'title':'Export to excel file'});
	$('.csv').attr({'title':'Export to csv file'});
});