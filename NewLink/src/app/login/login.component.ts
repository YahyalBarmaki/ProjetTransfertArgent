import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse } from '@angular/common/http';
import { AuthServiceService } from '../auth-service.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

  constructor(private authser: AuthServiceService) { }

  ngOnInit() { }
  onLogin(data) {
    this.authser.login(data)
      .subscribe(resp => {
      //  console.log(resp);
        const jwt = resp.body['token'];
        this.authser.saveToken(jwt);
          //   localStorage.setItem('token',token)
          // console.log(resp.headers.get('Authorization'));
          //  localStorage.setItem('token', resp.t);
        },
        err => console.log(err)
      );
       // console.log(resp.headers['token']);
       // let jwt = resp.headers.get('Authorization');
       // this.authser.saveToken(jwt);
  }

}
