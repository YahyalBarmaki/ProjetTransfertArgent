import { Component, OnInit } from '@angular/core';
import { AuthenticationService } from '../auth.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  constructor(private authser: AuthenticationService) { }

  ngOnInit() {
  }
  onLogin(data) {
    this.authser.login(data)
      .subscribe(resp => {
        console.log(resp);
      }, err => {
        }
      )  
  }
}
