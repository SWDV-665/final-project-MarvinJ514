import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import {FormBuilder, FormControl, FormGroup, Validators} from '@angular/forms';
import { PreferenceServiceProvider } from '../../providers/preference-service/preference-service';
@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  

  perfArray = [];
  //form = new FormGroup;

  constructor(public navCtrl: NavController, public fb:FormBuilder, public dataService: PreferenceServiceProvider) {
  
  }
  
  getChoices(){
      return this.dataService.choices;
  }
 
  addValue(data) {
    this.perfArray.push(data);
    console.log(this.perfArray);
  }

  arrayQuery(rawData):void{
    if(rawData != undefined){
        this.perfArray.push(rawData);
        console.log(this.perfArray);
    }
    else{
        console.log(this.perfArray);
    }
  }
}
