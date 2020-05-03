import { Component } from '@angular/core';
import { NavController } from 'ionic-angular';
import { EmailComposer } from '@ionic-native/email-composer';



@Component({
  selector: 'page-contact',
  templateUrl: 'contact.html'
})

export class ContactPage {

  constructor(public navCtrl: NavController/**, public emailComposer: EmailComposer **/) {
    
  }
  /**sendEmail(){
    this.emailComposer.isAvailable().then((available: boolean) =>{
        if(available) {
          //Now we know we can send
        }
    });
      
    let email = {
      to: 'vinpino514@gmail.com',
      cc: 'What2DoSTL@gmail.com',
      subject: 'Suggestions for app improvement',
      body: 'Could you please parse the Cardinals Events Calnendar',
      isHtml: true
    };
      
    // Send a text message using default options
    this.emailComposer.open(email);
  }**/
}
