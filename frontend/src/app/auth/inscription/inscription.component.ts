import { Component, OnInit } from '@angular/core';
import { Router } from '@angular/router';

import { AuthService } from '../auth.service';
import { User } from '../user';
@Component({
  selector: 'app-inscription',
  templateUrl: './inscription.component.html',
  styleUrls: ['./inscription.component.css']
})
export class InscriptionComponent implements OnInit {

  constructor(private authService: AuthService, private router: Router) { }

  ngOnInit() {
  }
  login(form) {
    console.log(form.value);
    this.authService.login(form.value).subscribe((res) => {
      console.log('Logged in!');
      this.router.navigateByUrl('home');
    });    
  }
}
