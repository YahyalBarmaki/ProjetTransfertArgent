import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { UserComponent } from './user/user.component';
import { AddUserComponent } from './add-user/add-user.component';
import { EditUserComponent } from './edit-user/edit-user.component';
import { LoginComponent } from './login/login.component';
import { PartenaireComponent } from './partenaire/partenaire.component';
import { AddPartenaireComponent } from './add-partenaire/add-partenaire.component';
import { EditPartenaireComponent } from './edit-partenaire/edit-partenaire.component';
import { UserService } from './user.service';
import { PartenaireService } from './partenaire.service';
import { AuthenticationService } from './auth.service';
@NgModule({
  declarations: [
    AppComponent,
    UserComponent,
    AddUserComponent,
    EditUserComponent,
    LoginComponent,
    PartenaireComponent,
    AddPartenaireComponent,
    EditPartenaireComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule
  ],
  providers: [AuthenticationService, UserService, PartenaireService],
  bootstrap: [AppComponent]
})
export class AppModule { }
