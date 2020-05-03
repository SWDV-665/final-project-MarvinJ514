import { Component } from '@angular/core';
import { InAppBrowser } from '@ionic-native/in-app-browser/ngx';
import { NavController } from 'ionic-angular';
import { Platform } from 'ionic-angular';

@Component({
  selector: 'page-home',
  templateUrl: 'home.html'
})
export class HomePage {

  constructor(public navCtrl: NavController, private InAppBrowser: InAppBrowser,private platform: Platform) {

  }
  subscription:any

  ngOnInit(){}

  launchSite(){
    this.InAppBrowser.create('http://18.225.37.184','_blank');
  }

  exitApp(){
    navigator['app'].exitApp();
  }

  ionViewDidEnter(){
    this.subscription = this.platform.backButton.subscribe(async()=>{
      navigator['app'].exitApp();
    });
  }

}
