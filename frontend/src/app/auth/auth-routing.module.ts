import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { InscriptionComponent } from './inscription/inscription.component';
import {  LoginComponent } from './login/login.component';

const routes: Routes = [
{path: 'inscription', component: InscriptionComponent},
{path: 'login', component: LoginComponent},
];
@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class AuthRoutingModule { }
