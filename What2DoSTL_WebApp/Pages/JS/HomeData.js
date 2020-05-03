// Get the modal
var modal = document.getElementById('id01');
            
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

$(document).ready(function(){
    var introTemplate = $("#intro_template").html();
    Mustache.parse(introTemplate);

    var introRendered = Mustache.render(introTemplate, {
        introduction: [
            {
                description: 'This applications attempts to simply answer the question "What is there to do in STL?" Through personalized preferences this application will attempt to provide results for activities in the St. Louis Area from a continually updated database of events. The database scrapes web accessible event calendars for various types of events and allows users to use one resource in order to find an event that best suits their needs.',
            },
        ],
        show: false
    })
    $("#introduction").html(introRendered);
});

$(document).ready(function(){
    var PrefTemplateTemplate = $("#Pref_template").html();
    Mustache.parse(PrefTemplateTemplate);

    var prefRendered = Mustache.render(PrefTemplateTemplate, {
        choices: [
            {
                input_id: "concerts",
                input_label: "Concerts"
            },
            {
                input_id: "rock",
                input_label: "Rock Music"
            },
            {
                input_id: "hiphop",
                input_label: "Hip hop Music"
            },
            {
                input_id: "country",
                input_label: "Country Music"
            },
            {
                input_id: "jazz",
                input_label: "Jazz Music"
            },
            {
                input_id: "pop",
                input_label: "Pop Music"
            },
            {
                input_id: "classical",
                input_label: "Classical Music"
            },
            {
                input_id: "folk",
                input_label: "Folk Music"
            },
            {
                input_id: "indoor",
                input_label: "Indoor Venue"
            },
            {
                input_id: "outdoor",
                input_label: "Outdoor Venue"
            },
            {
                input_id: "sports",
                input_label: "Sports"
            },
            {
                input_id: "baseball",
                input_label: "Baseball"
            },
            {
                input_id: "hockey",
                input_label: "Hockey"
            },
            {
                input_id: "soccer",
                input_label: "Soccer"
            },
            {
                input_id: "football",
                input_label: "Football"
            },
            {
                input_id: "basketball",
                input_label: "Basketball"
            },
            {
                input_id: "tennis",
                input_label: "Tennis"
            },
            {
                input_id: "parks",
                input_label: "Parks (nature)"
            },
            {
                input_id: "amusement_park",
                input_label: "Amusement Park"
            },
            {
                input_id: "brewery",
                input_label: "Breweries"
            },
            {
                input_id: "winery",
                input_label: "Wineries"
            },
            {
                input_id: "bar",
                input_label: "Bars"
            },
            {
                input_id: "festival",
                input_label: "Festivals"
            },
            {
                input_id: "camping",
                input_label: "Camping"
            },
            {
                input_id: "conventions",
                input_label: "Conventions"
            },
            {
                input_id: "arts",
                input_label: "Performing Arts"
            },
            {
                input_id: "comedy",
                input_label: "Comedy"
            },
            {
                input_id: "museums",
                input_label: "Museums"
            },
        ],
        show: false
    })
    $("#preferences").html(prefRendered);
});