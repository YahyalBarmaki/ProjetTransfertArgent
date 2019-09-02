import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { async, ComponentFixture, TestBed } from '@angular/core/testing';
import { CUSTOM_ELEMENTS_SCHEMA, NO_ERRORS_SCHEMA } from '@angular/core';
// tslint:disable-next-line: max-line-length
import { MatButtonModule, MatMenuModule, MatDatepickerModule, MatNativeDateModule , MatIconModule, MatCardModule, MatSidenavModule, MatFormFieldModule, MatInputModule, MatTooltipModule, MatToolbarModule } from '@angular/material';
import { MatRadioModule } from '@angular/material/radio';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { NavComponent } from './nav/nav.component';
import { HomeComponent } from './home/home.component';
import { LoginComponent } from './login/login.component';
import { FormsModule } from '@angular/forms';
import { ReactiveFormsModule } from '@angular/forms';
import { HttpClientModule, HttpClient } from '@angular/common/http';
import { AjoutUserComponent } from './ajout-user/ajout-user.component';
import { ListUserComponent } from './list-user/list-user.component';
@NgModule({
  declarations: [
    AppComponent,
    NavComponent,
    HomeComponent,
    LoginComponent,
    AjoutUserComponent,
    ListUserComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    FormsModule,
    MatButtonModule,
    MatMenuModule,
    MatDatepickerModule,
    MatNativeDateModule,
    MatIconModule,
    MatRadioModule,
    MatCardModule,
    MatSidenavModule,
    MatFormFieldModule,
    MatInputModule,
    MatTooltipModule,
    MatToolbarModule,
    AppRoutingModule,
    ReactiveFormsModule,
    HttpClientModule
  ],
  providers: [ HttpClient, HttpClientModule, MatDatepickerModule],
  bootstrap: [AppComponent],
})

export class AppModule { }
