import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { ListUserComponent } from './list-user/list-user.component';
import { AjoutUserComponent } from './ajout-user/ajout-user.component';
import { AddPartenaireComponent } from './add-partenaire/add-partenaire.component';
const routes: Routes = [
  { path: '', component: HomeComponent },
  { path: 'login', component: LoginComponent },
  { path: 'inscris', component: AjoutUserComponent },
  { path: 'listeU', component: ListUserComponent },
  { path: 'addpart', component: AddPartenaireComponent},

  { path: '**', redirectTo: '', pathMatch: 'full' }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
