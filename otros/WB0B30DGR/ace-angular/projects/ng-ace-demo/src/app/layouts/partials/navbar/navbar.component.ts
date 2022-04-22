import { Component, OnInit} from '@angular/core';

@Component({
  selector: 'app-navbar',
  templateUrl: './navbar.component.html',
  styleUrls: []
})
export class NavbarComponent implements OnInit {

  megaOpen!: boolean;
  isNavbarMenuCollapsed = true

  constructor(
  ) {
    this.megaOpen = false
  }


  ngOnInit(): void {
  }

  toggleNavbarMenu() {
    this.isNavbarMenuCollapsed = !this.isNavbarMenuCollapsed
  }

}
