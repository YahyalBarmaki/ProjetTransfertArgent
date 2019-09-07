import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { HttpClientModule } from '@angular/common/http';

import { AuthRoutingModule } from './auth-routing.module';
import { InscriptionComponent } from './inscription/inscription.component';
import { LoginComponent } from './login/login.component';

@NgModule({
  declarations: [InscriptionComponent, LoginComponent],
  imports: [
    CommonModule,
    FormsModule,
    HttpClientModule,
    AuthRoutingModule
  ]
})
export class AuthModule { }
