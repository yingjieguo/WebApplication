(function(){Date.prototype.deltaDays=function(c){return new Date(this.getFullYear(),this.getMonth(),this.getDate()+c)};Date.prototype.getSunday=function(){return this.deltaDays(-1*this.getDay())}})();
function Week(c){this.sunday=c.getSunday();this.nextWeek=function(){return new Week(this.sunday.deltaDays(7))};this.prevWeek=function(){return new Week(this.sunday.deltaDays(-7))};this.contains=function(b){return this.sunday.valueOf()===b.getSunday().valueOf()};this.getDates=function(){for(var b=[],a=0;7>a;a++)b.push(this.sunday.deltaDays(a));return b}}
function Month(c,b){this.year=c;this.month=b;this.nextMonth=function(){return new Month(c+Math.floor((b+1)/12),(b+1)%12)};this.prevMonth=function(){return new Month(c+Math.floor((b-1)/12),(b+11)%12)};this.getDateObject=function(a){return new Date(this.year,this.month,a)};this.getWeeks=function(){var a=this.getDateObject(1),b=this.nextMonth().getDateObject(0),c=[],a=new Week(a);for(c.push(a);!a.contains(b);)a=a.nextWeek(),c.push(a);return c}};


var mos = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var names = ["Sun", "Mon", "Tue", "Wed", "Thr", "Fri", "Sat"];
// Today's date
var now = new Date();
var toDay = now.getDate();
var todaymonth = now.getMonth();
var todayyear = now.getFullYear();
var currentmo = new Month(now.getFullYear(), now.getMonth());
var nextMonth = currentmo.nextMonth();
var prevMonth = currentmo.prevMonth();

// For security use, will be filled in the login phase
var token;

// Get content and title and tag

// JQuery 
$(function() {
    // Display the current month and year immediately when the page is loaded
    updateCalendar();
    //displayevents();
    $("#loginform").show();
    $("#registerform").show();
    $("#logout").hide();
    $("#addEvent").hide();
    $("#deleteEvent").hide();
    $("#editEvent").hide();
    $("#filterform").hide();
    // $("#date").datepicker({
    //            showButtonPanel: true
    //        });
    // $("#deleteDate").datepicker({
    //            showButtonPanel: true
    //        });

    $("#nextMonthButton").click(function(event) {
        // Display new days
        currentmo = currentmo.nextMonth();
        updateCalendar();
        displayevents();

    });
    $("#prevMonthButton").click(function(event) {
        // Display new days
        currentmo = currentmo.prevMonth();
        updateCalendar();
        displayevents();
    });


    // Update the calendar
    function updateCalendar() {

        // Clear the table
        $('.day').remove();
        $('.cell').remove();

        // Display the current month and year
        $("#monthHeader").html(mos[currentmo.month] + " " + currentmo.year);


        // Get the weeks
        var weeks = currentmo.getWeeks();

        $table = $('#table');
        //var inserttable = document.createElement('table'),tr,td,cell;
        var tr, td;
        for (var i = 0; i <= weeks.length; i++) {
            tr = document.createElement('tr');
            tr.className = "day";
            if (i == 0) {

            } else {
                var thisSunday = weeks[i - 1].sunday;
            }
            for (var j = 0; j < 7; j++) {
                td = document.createElement('td');
                td.className = "cell";
                if (i == 0) {
                    td.innerHTML = names[j];
                } else {
                    var thisDay = thisSunday.deltaDays(j);
                    if (thisDay.getMonth() != currentmo.month) {} else {
                        td.innerHTML = thisDay.getDate();
                    }

                }
                tr.append(td);
            }
            table.appendChild(tr);
        }
        //table.appendChild(tr);
        table = document.getElementById('table');
        // Get each cell
        var tdid = table.getElementsByTagName('td');
        // For each cell
        for (var i = tdid.length - 1; i > 0; i--) {
            var td = tdid[i];
            if (td.innerHTML != null) {
                td.id = td.innerHTML;
            }
        }
        if (todaymonth == currentmo.month && todayyear == currentmo.year) {
            $('#' + toDay).css("background-color", "#ffb3b3");
        }
    } // End of updateCalendar function
    function displayevents() {

        var year = currentmo.year;
        var month = currentmo.month + 1;
        var dataString = "cmonth=" + encodeURIComponent(month) + "&cyear=" + encodeURIComponent(year);
        var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
        xmlHttp.open("POST", "loadEvents_ajax.php", true);
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlHttp.addEventListener("load", loadEventsCallback, false);
        xmlHttp.send(dataString);
    }

    function loadEventsCallback() {
        var jsonData = JSON.parse(event.target.responseText);
        if (jsonData.success) {
            var eventdata = JSON.parse(jsonData.result);
            for (var k = 0; k < eventdata.length; k++) {
                if (eventdata[k].event_tag==$('input[name=tag]:checked').val()|| $('input[name=tag]:checked').val()==null){
                    var date = parseInt(eventdata[k].event_day);
                    $('#' + date).append('<div class="event_day" event-id="' + eventdata[k].event_id + '"' + 'event-title="' + eventdata[k].event_title + '"' + 'event-tag="' + eventdata[k].event_tag + '">' + eventdata[k].event_title + ' ' + eventdata[k].event_time + '</div>');
                }
            }
        } else {
            alert("Error!!!!!" + jsonData.message);
        }
    }
    $("#filterButton").click(updateCalendar);
    $("#filterButton").click(displayevents);

    
    function registerAjax(event) {
        var registername = document.getElementById("registerUsername").value;
        var password = document.getElementById("registerPassword").value;

        var dataString = "registername=" + encodeURIComponent(registername) + "&password=" + encodeURIComponent(password);
        var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
        xmlHttp.open("POST", "register_ajax.php", true);
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlHttp.addEventListener("load", function(event) {
            var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
            if (jsonData.success) {
                alert("REGISTER SUCCESS");
            } else {
                alert("ERROR" + jsonData);
            }
        }, false);
        xmlHttp.send(dataString);
    }
    $("#registerButton").click(registerAjax);

    function loginAjax(event) {
        var username = document.getElementById("username").value; // Get the username from the form
        var password = document.getElementById("password").value; // Get the password from the form
        // Make a URL-encoded string for passing POST data:
        var dataString = "username=" + encodeURIComponent(username) + "&password=" + encodeURIComponent(password);

        var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
        xmlHttp.open("POST", "login_ajax.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
        xmlHttp.addEventListener("load", function(event) {
            var jsonData = JSON.parse(event.target.responseText); // parse the JSON into a JavaScript object
            if (jsonData.success) { // in PHP, this was the "success" key in the associative array; in JavaScript, it's the .success property of jsonData
                // alert("You've been Logged In!");
                $("#loginform").hide();
                $("#registerform").hide();
                document.getElementById("result").textContent = "Welcome, " + username;
                $("#logout").show();
                $("#addEvent").show();
                $("#deleteEvent").show();
                $("#editEvent").show();
                $("#filterform").show();
                var date = new Date();
                var currentmonth = date.getMonth(); //need to implement
                displayevents();
            } else {
                alert("You were not logged in.  " + jsonData.message);
            }
        }, false); // Bind the callback to the load event
        xmlHttp.send(dataString); // Send the data
    }

    $("#loginButton").click(loginAjax);

    function logoutAjax(event) {

        var xmlHttp = new XMLHttpRequest(); // Initialize our XMLHttpRequest instance
        xmlHttp.open("POST", "logout_ajax.php", true); // Starting a POST request (NEVER send passwords as GET variables!!!)
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // It's easy to forget this line for POST requests
        xmlHttp.addEventListener("load", function(event) {
            alert("You've been logged out successfully!");
            $("#loginform").show();
            $("#registerform").show();
            $("#logout").hide();
            $("#addEvent").hide();
            $("#deleteEvent").hide();
            $("#editEvent").hide();
            $("#filterform").hide();
            document.getElementById("result").textContent = "Welcome,guest";

            updateCalendar();
            //displayEvent();

            // Change the login status
            //$("#loginStatus").html("Welcome, ayayayayGuest");
        }, false); // Bind the callback to the load eventad
        xmlHttp.send(null);
    }

    $("#logoutButton").click(logoutAjax);

    function addEventAjax(event) {
        var title = $("#title").val();
        var date = $("#date").val();
        var time = $("#time").val();
        var tag = $("#addEventTag option:selected").text();
        var shareuser1 = $("#share1").val();
        var shareuser2 = $("#share2").val();



        var dateArray = date.split("/");
        if (dateArray.length != 3) {
            alert("DATE FORMAT SHOULE BE dd/mm/year");
        } else {
            var eventDay = dateArray[1];
            var eventMonth = dateArray[0];
            var eventYear = dateArray[2];

        }


        var info = "title=" + encodeURIComponent(title) + "&eventDay=" + encodeURIComponent(eventDay) + "&eventMonth=" + encodeURIComponent(eventMonth) + "&eventYear=" + encodeURIComponent(eventYear) + "&tag=" + encodeURIComponent(tag) + "&time=" + encodeURIComponent(time)+"&share1="+encodeURIComponent(shareuser1)+"&share2="+encodeURIComponent(shareuser2);

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", "addEvent.php", true);
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlHttp.addEventListener("load", function(event) {
            Data = JSON.parse(event.target.responseText);
            if (Data.success) {
                //$("#addEvent").dialog("close");//
                alert("Event create success.");
                updateCalendar();
                displayevents();
            } else {
                alert("Event create fail.");
            }
        }, false);
        xmlHttp.send(info);
    }
    $("#addEventButton").click(addEventAjax);

    function editEventAjax(event) {
        // alert("success in");
        var eid;
        //old part
        var title = $("#oldTitle").val();
        var date = $("#oldDate").val();
        var oldtime = $("#oldTime").val();
        //new part
        var newtitle = $("#newTitle").val();
        var newdate = $("#newDate").val();
        var time = $("#newTime").val();
        var tag = $("#newEventTag option:selected").text();
        //old part
        var dateArray = date.split("/");
        if (dateArray.length != 3) {
            alert("DATE FORMAT SHOULE BE dd/mm/year");
        } else {
            var eventDay = dateArray[1];
            var eventMonth = dateArray[0];
            var eventYear = dateArray[2];

        }

        //new part
        var newdateArray = newdate.split("/");
        if (newdateArray.length != 3) {
            alert("DATE FORMAT SHOULE BE dd/mm/year");
        } else {
            var neweventDay = newdateArray[1];
            var neweventMonth = newdateArray[0];
            var neweventYear = newdateArray[2];
        }
        //first xmlrequest data
        //var info0 = "title="+encodeURIComponent(title)+"&eventDay="+encodeURIComponent(eventDay)+"&eventMonth="+encodeURIComponent(eventMonth)+"&eventYear="+encodeURIComponent(eventYear);
        //second xmlrequest data
        var info = "title=" + encodeURIComponent(title) + "&eventDay=" + encodeURIComponent(eventDay) + "&eventMonth=" + encodeURIComponent(eventMonth) + "&eventYear=" + encodeURIComponent(eventYear) + "&eventTime=" + encodeURIComponent(oldtime) + "&newtitle=" + encodeURIComponent(newtitle) + "&newday=" + encodeURIComponent(neweventDay) + "&newmonth=" + encodeURIComponent(neweventMonth) + "&newyear=" + encodeURIComponent(neweventYear) + "&newtag=" + encodeURIComponent(tag) + "&newtime=" + encodeURIComponent(time);

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", "editEvent.php", true);
        // alert("open success");
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        // alert("header success");
        xmlHttp.addEventListener("load", function(event) {
            Data = JSON.parse(event.target.responseText);
            if (Data.success) {
                // $("#editEvent").dialog("close");//
                updateCalendar(); //need fix
                displayevents();
                alert("Event edit success.");
            } else {
                alert("Event edit fail.");
            }
        }, false);
        xmlHttp.send(info);

    }
    $("#editEventButton").click(editEventAjax);

    function deleteEventAjax(event) {
        var title = $("#deleteTitle").val();
        var date = $("#deleteDate").val();
        var time = $("#deleteTime").val();
        var dateArray = date.split("/");
        if (dateArray.length != 3) {
            alert("DATE FORMAT SHOULE BE dd/mm/year");
        } else {
            var eventDay = dateArray[1];
            var eventMonth = dateArray[0];
            var eventYear = dateArray[2];

        }

        var info = "title=" + encodeURIComponent(title) + "&eventDay=" + encodeURIComponent(eventDay) + "&eventMonth=" + encodeURIComponent(eventMonth) + "&eventYear=" + encodeURIComponent(eventYear) + "&eventTime=" + encodeURIComponent(time);

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.open("POST", "deleteEvent.php", true);
        xmlHttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xmlHttp.addEventListener("load", function(event) {
            Data = JSON.parse(event.target.responseText);
            if (Data.success) { //
                alert("Delete edit success.");
                updateCalendar();
                displayevents();
            } else {
                alert("Event edit fail.");
            }
        }, false);
        xmlHttp.send(info);
    }
    $("#deleteEventButton").click(deleteEventAjax);









});
