import { Component } from '@angular/core';
import { AuthServiceService } from './auth-service.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'NewLink';
 constructor(private authser: AuthServiceService) {}
  isSuperAdmin() {
    return this.authser.isSuperAdmin();
  }
  isPartenaire() {
    return this.authser.isPartenaire();
  }
  isCassier() {
    return this.authser.isCassier();
  }
  isAuthentifier() {
    return this.authser.isAuthentifier();
  }
}
