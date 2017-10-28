.PHONY: main init check boot run clean

main: check

init:
	if [ ! -d "ansible-retry" ]; then mkdir "ansible-retry"; fi
	ansible-galaxy install -f -p roles -r requirements.yml

check:
	ansible-playbook --syntax-check setup*.yml

boot:
	vagrant up

run:
	vagrant provision

clean:
	rm -f setup.retry builds/output.*
	vagrant destroy -f
