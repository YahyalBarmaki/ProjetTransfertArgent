import { Component, OnInit } from '@angular/core';
import { HttpClient, HttpHeaders, HttpResponse } from '@angular/common/http';
import { AuthServiceService } from '../auth-service.service';
import { JwtHelperService } from '@auth0/angular-jwt';
import { Router } from '@angular/router';



@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {
  helper = new JwtHelperService();
  constructor(private authser: AuthServiceService,
  // tslint:disable-next-line: align
  private route: Router) { }

  ngOnInit() { }
  onLogin(data) {
    this.authser.login(data)
      .subscribe(resp => {
        //console.log(resp);
        const token = resp.token;
        localStorage.setItem('token', resp.token);
        const decodedToken = this.helper.decodeToken(token);
        console.log(decodedToken);
        localStorage.setItem('username', decodedToken.username);
        localStorage.setItem('roles', decodedToken.roles[0]);
        localStorage.setItem('exp', decodedToken.exp);
        console.log(localStorage);
        // this.route.navigate(['/listeU']);
       // const jwt = resp.body['token'];
      //  this.authser.saveToken(jwt);
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
