
import { Injectable } from '@angular/core';

/*
  Generated class for the PreferenceServiceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class PreferenceServiceProvider {

  choices= [
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
    }
  ];

  constructor() {
    console.log('Hello PreferenceServiceProvider Provider');
  }

}
