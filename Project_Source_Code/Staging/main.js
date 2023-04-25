//Imports
console.log(__dirname);
const express = require('express');
const app = express();
const port = 3000;


// Static Files
app.use(express.static(__dirname)); // + '/Staging'

//app.use('/CSS.', express.static(__dirname+ '/CSS'));
// app.use('/js.', express.static(__dirname+ '/js'));
//app.use('/img.', express.static(__dirname+ '/img'));


app.get('',(req, res)=> {
    res.sendFile(__dirname + '/pages/current_timeline.html');// timeline   current_timeline.html
})
// horizontal_example   // experimental




// Listen on port 3000      Second argument provides log to console
app.listen(port,()=>console.info(`Listening on port ${port}`));

