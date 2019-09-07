import { Component} from '@angular/core';
import { AuthServiceService } from './auth-service.service';
import { HttpClient } from '@angular/common/http';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent {
  title = 'NewLink';
 constructor(private http: HttpClient , private authser: AuthServiceService) {}

}
