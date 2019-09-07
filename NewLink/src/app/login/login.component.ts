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
        const token = resp.token;
        localStorage.setItem('token', resp.token);
        const decodedToken = this.helper.decodeToken(token);
        console.log(decodedToken);
        localStorage.setItem('username', decodedToken.username);
        localStorage.setItem('roles', decodedToken.roles[0]);
        localStorage.setItem('exp', decodedToken.exp);
        // tslint:disable-next-line: whitespace
        if (decodedToken.roles[0] === 'ROLE_SUPER_ADMIN') {
          this.route.navigate(['/listeU']);
        }
        console.log(localStorage);
        },
        err => console.log(err)
      );
  }
 

}
