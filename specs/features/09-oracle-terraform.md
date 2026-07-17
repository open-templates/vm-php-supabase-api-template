---
type: Feature
title: Oracle Terraform
description: OCI compute + cloud-init bootstrap for production.
tags: [terraform, oracle, deployment]
timestamp: 2026-07-17T00:00:00Z
---

# Oracle Terraform

Path: `infrastructure/terraform/oracle/`

Creates an **OCI compute** instance (Always Free shape `VM.Standard.E2.1.Micro`) with:

- Public IP on supplied `subnet_id`
- SSH key metadata
- cloud-init `user_data` from `infrastructure/cloud-init/user-data.yaml.tpl`

cloud-init: Docker install, `git clone` of `git_repo_url`, `docker compose up -d`.

Variables: `terraform.tfvars.example` — `compartment_id`, `region`, `availability_domain`, `subnet_id`, `ssh_public_key`, `git_repo_url`.

Outputs: `public_ip`.

Operators must configure OCI credentials and network security (22, 80/443) separately.
