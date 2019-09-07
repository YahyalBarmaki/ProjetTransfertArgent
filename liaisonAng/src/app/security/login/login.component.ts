import { Component, OnInit } from '@angular/core';
import { from } from 'rxjs';
import { AuthServiceService } from '../../authdoss/auth-service.service';
@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  constructor(private authser: AuthServiceService) { }

  ngOnInit() {
  }
  onLogin(data) {
    this.authser.login(data)
      .subscribe(resp => {
        console.log(resp);
      },
        err => console.log(err));
  }
}
