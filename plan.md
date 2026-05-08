## Plan: Pothole Fixer Sprint

Build a small Laravel app for reporting potholes with a public Blade UI, no authentication, a real locations table, seeded demo data, and a simple one-click status toggle. The priority is to remove setup friction early: lock the data model first, then wire the RESTful controller and routes, then build the UI around that contract, and only then polish and test. The landing page should become the app dashboard instead of the default Laravel welcome page.

This plan is aligned to the assignment requirements:
- Use the current Laravel skeleton already in the repo...
- Include at least 2 models with a relationship.
- Follow RESTful patterns with controller and route structure.
- Provide a Blade interface rather than an API-only solution.
- Deliver proper migrations, realistic seed data, one full CRUD resource, one meaningful feature, and README documentation covering concept, installation, usage, and Momentum scaling.

**Steps**
1. Lock the scope assumptions and keep them fixed for the sprint.
2. Build the data model before touching the UI.
   - Create Location and PotholeReport models plus migrations.
3. Seed useful demo data immediately after the schema is in place.
4. Define the route surface and controller responsibilities before building the views.
5. Build the Blade UI.
6. Add validation and user-facing behavior.
7. Write focused tests before polishing too much.
8. Finish with documentation and a quick quality pass.
